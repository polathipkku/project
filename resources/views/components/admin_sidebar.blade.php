<section class="sticky bg-white rounded-2xl p-2" id="nav-content"
    style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">

    <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">
        <!-- Logo Section -->
        <div style="display: grid; place-items: center; margin-bottom: 30px;">
            <img src="{{ asset('images/Logo.jpg') }}" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
            <div class="text-black text-lg">Tunthree</div>
        </div>

        <!-- Menu Items -->
        @php
        $lowStockItems = DB::table('products')
        ->join('stocks', 'products.stocks_id', '=', 'stocks.id')
        ->join('stock_packages', 'stocks.id', '=', 'stock_packages.stock_id') // ✅ เชื่อมกับ stock_packages
        ->join('product_types', 'products.product_types_id', '=', 'product_types.id')
        ->where('product_types.product_type_name', '=', 'เครื่องอาบน้ำ')
        ->where('stock_packages.pack_qty', '=', 1) // ✅ ใช้ stock_packages.pack_qty
        ->count();


        $repairCounts = DB::table('checkout_details')
        ->whereIn('thing_status', ['ซ่อมสำเร็จ', 'ซื้อเปลี่ยนสำเร็จ'])
        ->count();

        $menuItems = [
        ['id' => 'dashboard', 'label' => 'แดชบอร์ด', 'icon' => 'fa-solid fa-chart-line', 'route' => route('dashboard')],
        ['id' => 'employee', 'label' => 'พนักงาน', 'icon' => 'fa-users', 'route' => route('employee')],
        ['id' => 'room', 'label' => 'ห้อง', 'icon' => 'fa-door-open', 'route' => route('room')],
        ['id' => 'product', 'label' => 'สต็อก', 'icon' => 'fa-house-circle-check', 'route' => route('product')],
        ['id' => 'promotions', 'label' => 'โปรโมชั่น', 'icon' => 'fa-rectangle-ad', 'route' => route('promotions')],
        ['id' => 'productroom', 'label' => 'ค่าเสียหาย', 'icon' => 'fa-house-chimney-crack', 'route' => route('productroom')],
        ['id' => 'expenses', 'label' => 'ค่าใช้จ่าย', 'icon' => 'fas fa-money-bill', 'route' => route('expenses')],
        ['id' => 'payment_types.index', 'label' => 'ประเภทการจ่าย', 'icon' => 'fa-solid fa-cash-register', 'route' => route('payment_types.index')],
        ['id' => 'repairreport', 'label' => 'ประวัติการซ่อม', 'icon' => 'fa-solid fa-hammer', 'route' => route('repairreport'), 'badge' => $repairCounts],
        ['id' => 'record', 'label' => 'ประวัติการจอง', 'icon' => 'fa-database', 'route' => route('record')],
        ['id' => 'Items', 'label' => 'จัดการสินค้า', 'icon' => 'fa-solid fa-box', 'route' => route('Items'), 'badge' => $lowStockItems]
        ];
        $currentRoute = Route::currentRouteName();
        @endphp

        @foreach ($menuItems as $item)
        <a href="{{ $item['route'] }}"
            class="relative inline-block py-2 px-3 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out 
               {{ $currentRoute === $item['id'] ? 'text-blue-700 bg-blue-100 rounded-lg' : 'text-gray-500 hover:text-blue-700 hover:bg-gray-100 hover:rounded-lg' }}">
            <div class="mr-2 text-base flex items-center">
                <i class="fa-solid {{ $item['icon'] }} mr-1"></i>{{ $item['label'] }}
                @if(isset($item['badge']) && $item['badge'] > 0)
                <span class="absolute bg-red-600 text-white px-2 py-1 text-xs font-bold rounded-full -top-2 -right-2">
                    {{ $item['badge'] }}
                </span>
                @endif
            </div>
        </a>
        @endforeach

        <!-- Logout -->
        <button
            class="inline-block py-2 px-3 text-gray-500 lg:flex lg:flex-col items-start justify-start mb-6 transition duration-300 ease-in-out hover:text-red-500"
            style="position: absolute; bottom: 10px;"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="mr-2 text-base flex items-center">
                <i class="fa-solid fa-right-from-bracket fa-flip-horizontal mr-1"></i>ออกจากระบบ
            </div>
        </button>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
    </div>
</section>