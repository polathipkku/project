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
        $menuItems = [
        ['id' => 'emroom', 'label' => 'ห้อง', 'icon' => 'fa-solid fa-door-open', 'route' => route('emroom')],
        ['id' => 'checkin', 'label' => 'เช็คอิน', 'icon' => 'fa-solid fa-person-walking-luggage', 'route' => route('checkin')],
        ['id' => 'checkout', 'label' => 'เช็คเอาท์', 'icon' => 'fa-solid fa-person-walking-luggage fa-flip-horizontal', 'route' => route('checkout')],
        ['id' => 'store', 'label' => 'คลังเก็บของ', 'icon' => 'fa-solid fa-house-circle-check', 'route' => route('store')],
        ['id' => 'maintenanceroom', 'label' => 'ซ่อมบำรุง', 'icon' => 'fa-solid fa-tools', 'route' => route('maintenanceroom')],
        ];
        $currentRoute = Route::currentRouteName();
        @endphp

        @foreach ($menuItems as $item)
        <a href="{{ $item['route'] }}"
            class="inline-block py-2 px-3 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out 
               {{ $currentRoute === $item['id'] ? 'text-blue-700 bg-blue-100 rounded-lg' : 'text-gray-500 hover:text-blue-700 hover:bg-gray-100 hover:rounded-lg' }}">
            <div class="mr-2 text-base flex items-center">
                <i class="fa-solid {{ $item['icon'] }} mr-1"></i>{{ $item['label'] }}
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

        <!-- Hidden Logout Form -->
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
    </div>
</section>
