<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'stock_qty',
        'pack_qty',
        'items_per_pack',
        'update_qty',
        'update_by',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'stocks_id');
    }

    public function getAvailableExtraBeds()
    {
        // ค้นหาสินค้าเตียงเสริมในสต็อก
        $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();

        if (!$extraBedProduct) {
            return 0;
        }

        // ค้นหาสต็อกที่เชื่อมโยงกับสินค้าเตียงเสริม
        $stock = $this->whereHas('products', function ($query) use ($extraBedProduct) {
            $query->where('id', $extraBedProduct->stocks_id);
        })->first();

        return $stock ? $stock->stock_qty : 0;
    }
    public function stockPackages()
    {
        return $this->hasMany(StockPackage::class);
    }
}
