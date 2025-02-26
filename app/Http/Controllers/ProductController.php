<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sale;
use App\Models\Product_type;
use App\Models\StockPackage;

class ProductController extends Controller
{

    public function product()
    {
        $product = Product::whereHas('productType', function ($query) {
            $query->where('product_type_name', 'เครื่องนอน');
        })->get();

        $product_types = $this->product_types();
        return view('owner.product', compact('product', 'product_types'));
    }
    public function add_items()
    {
        $product = Product::all();
        $product_types = $this->product_types();
        return view('owner.add_items', compact('product', 'product_types'));
    }
    public function items()
    {
        $product = Product::whereHas('productType', function ($query) {
            $query->where('product_type_name', 'เครื่องอาบน้ำ');
        })->get();

        $product_types = $this->product_types();
        return view('owner.items', compact('product', 'product_types'));
    }


    public function add_product()
    {
        $product = Product::all();
        $product_types = $this->product_types();
        return view('owner.add_product', compact('product', 'product_types'));
    }

    public function store()
    {
        $drinks = Product::with('stock', 'productType')
            ->whereHas('productType', function ($query) {
                $query->where('product_type_name', 'เครื่องอาบน้ำ'); // เปลี่ยนจาก 'เครื่องดื่ม' เป็น 'เครื่องอาบน้ำ'
            })
            ->get();

        return view('employee.store', compact('drinks'));
    }


    public function product_types()
    {
        $product_types = Product_type::pluck('product_type_name')->toArray();
        return $product_types;
    }
    public function addProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'product_price' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_status' => 'required',
            'stock_qty' => 'required',
            'product_type_name' => 'required',
        ]);

        // สร้าง Stock
        $stock = new Stock();
        $stock->stock_qty = $request->stock_qty;
        $stock->update_qty = 0;
        $stock->update_by = auth()->user()->id;
        $stock->save();

        // สร้าง Product Type
        $productType = new Product_type();
        $productType->product_type_name = $request->product_type_name;
        $productType->save();

        // สร้าง Product
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_status = $request->product_status;

        $imageName = time() . '.' . $request->product_img->extension();
        $request->product_img->move(public_path('images'), $imageName);
        $product->product_img = $imageName;

        // เชื่อมโยงกับ Stock และ Product Type
        $product->stock()->associate($stock);
        $product->productType()->associate($productType);

        $product->save();
        return redirect()->route('product')->with('success', "เพิ่มข้อมูลสำเร็จ");
    }

    public function additem(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'pack_qty' => 'nullable|integer|min:1',
            'items_per_pack' => 'nullable|integer|min:1',
            'package_type' => 'required|in:แพ็คใหญ่,แพ็คเล็ก',
        ]);

        // คำนวณ stock_qty ถ้ามีค่า pack_qty และ items_per_pack
        $stock_qty = $request->pack_qty * $request->items_per_pack;

        // สร้าง Stock
        $stock = new Stock();
        $stock->stock_qty = $stock_qty;
        $stock->update_qty = 0;
        $stock->update_by = auth()->user()->id;
        $stock->save();

        // บันทึกข้อมูลใน stock_packages
        $stockPackage = new StockPackage();
        $stockPackage->stock_id = $stock->id;
        $stockPackage->pack_qty = $request->pack_qty;
        $stockPackage->items_per_pack = $request->items_per_pack;
        $stockPackage->package_type = $request->package_type;
        $stockPackage->save();

        // ตรวจสอบว่ามี Product Type "เครื่องอาบน้ำ" หรือยัง ถ้ายังไม่มีให้สร้างใหม่
        $productType = Product_type::firstOrCreate(['product_type_name' => 'เครื่องอาบน้ำ']);

        // สร้าง Product
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_status = 'พร้อมให้บริการ';

        // เชื่อมโยงกับ Stock และ Product Type
        $product->stock()->associate($stock);
        $product->productType()->associate($productType);

        $product->save();

        return redirect()->route('items')->with('success', "เพิ่มข้อมูลสำเร็จ");
    }


    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $product_types = $this->product_types();
        return view('owner.editproduct', compact('product', 'product_types'));
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'pack_qty' => 'required|integer|min:1',
            'items_per_pack' => 'required|integer|min:1',
            'package_type' => 'required|in:แพ็คใหญ่,แพ็คเล็ก',
        ]);

        $product = Product::findOrFail($id);

        // คำนวณ stock ใหม่
        $additionalStock = $request->pack_qty * $request->items_per_pack;

        // บันทึกข้อมูลลง StockPackage (สร้างแถวใหม่)
        StockPackage::create([
            'stock_id' => $product->stock->id, // เชื่อมกับ stock_id
            'pack_qty' => $request->pack_qty,
            'items_per_pack' => $request->items_per_pack,
            'package_type' => $request->package_type, // แพ็คใหญ่/แพ็คเล็ก
        ]);

        // อัปเดต stock_qty ใน stocks
        if ($product->stock) {
            $product->stock->increment('stock_qty', $additionalStock);
        } else {
            // ถ้ายังไม่มี stock ให้สร้างใหม่
            $product->stock()->create([
                'stock_qty' => $additionalStock,
                'update_by' => auth()->user()->name, // ใส่ชื่อคนอัปเดต
                'update_qty' => $additionalStock,
            ]);
        }

        return back()->with('success', 'Stock ถูกอัปเดต และบันทึกแพ็คเรียบร้อยแล้ว');
    }




    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'product_name' => 'required|unique:products,product_name,' . $id,
            'product_price' => 'required',
            'product_status' => 'required',
            'stock_qty' => 'required',
            'product_type_name' => 'required',
        ]);

        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_status = $request->product_status;

        // อัพเดต Stock และ Product Type
        $product->stock->stock_qty = $request->stock_qty;
        $product->stock->update_by = auth()->user()->id;
        $product->stock->save();

        $productType = Product_type::firstOrCreate(['product_type_name' => $request->product_type_name]);
        $product->productType()->associate($productType);

        $product->save();
        return redirect()->route('items')->with('success', "อัพเดตข้อมูลสำเร็จ");
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        // ตรวจสอบว่ามีสินค้านี้หรือไม่
        if (!$product) {
            return redirect()->route('product')->with('error', "ไม่พบสินค้าที่ต้องการลบ");
        }

        // ลบไฟล์รูปภาพ (ถ้ามี)
        if ($product->product_img) {
            unlink(public_path('images') . '/' . $product->product_img);
        }

        // ลบ Stock ที่เกี่ยวข้อง
        if ($product->stock) {
            $product->stock->delete();
        }

        // ลบ Product Type ที่ไม่ได้เชื่อมโยงกับสินค้าอื่น
        if ($product->productType && $product->productType->products->count() == 1) {
            $product->productType->delete();
        }

        // ลบสินค้า
        $product->delete();

        return redirect()->route('product')->with('success', "ลบข้อมูลสำเร็จ");
    }

    public function buyProduct(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $quantityToBuy = $request->input('quantity');
        $paymentMethod = $request->input('payment_method');
        $paymentDetails = [];

        // Check stock quantity
        if ($product->stock->stock_qty >= $quantityToBuy) {
            // Deduct stock quantity
            $product->stock->stock_qty -= $quantityToBuy;
            $product->stock->save();

            // Calculate total price
            $totalPrice = $product->product_price * $quantityToBuy;

            // Add sale record
            $sale = new Sale();
            $sale->product_id = $product->id;
            $sale->user_id = auth()->id();
            $sale->quantity = $quantityToBuy;
            $sale->total_price = $totalPrice;
            $sale->payment_method = $paymentMethod;

            // If cash payment, calculate change
            if ($paymentMethod === 'cash') {
                $receivedAmount = $request->input('received_amount');
                $sale->change_amount = $receivedAmount - $totalPrice; // Store change amount
                $paymentDetails = [
                    'totalPrice' => $totalPrice,
                    'receivedAmount' => $receivedAmount,
                    'changeAmount' => $sale->change_amount,
                ];
            }

            // Save sale record
            $sale->save();

            return response()->json(['message' => 'การชำระเงินสำเร็จ!', 'paymentDetails' => $paymentDetails]);
        } else {
            return response()->json(['message' => 'Insufficient stock!'], 400);
        }
    }
}
