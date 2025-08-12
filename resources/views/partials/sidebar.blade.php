<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            
            @if(Auth::user()->isAdmin())
            <li>
                <a href="{{ route('categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('categories.*') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                    </svg>
                    <span class="ml-3">Kategori</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('suppliers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('suppliers.*') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 000-2H9zM7 9a3 3 0 016 0v5a1 1 0 11-2 0v-5a1 1 0 10-2 0v5a1 1 0 11-2 0V9z"/>
                    </svg>
                    <span class="ml-3">Supplier</span>
                </a>
            </li>
            @endif
            
            <li>
                <a href="{{ route('products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('products.*') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    <span class="ml-3">Produk</span>
                </a>
            </li>
            
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="dropdown-stock" data-collapse-toggle="dropdown-stock">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Stok</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="dropdown-stock" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('stock-in.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ request()->routeIs('stock-in.*') ? 'bg-gray-100' : '' }}">Stok Masuk</a>
                    </li>
                    <li>
                        <a href="{{ route('stock-out.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ request()->routeIs('stock-out.*') ? 'bg-gray-100' : '' }}">Stok Keluar</a>
                    </li>
                    @if(Auth::user()->isAdmin() || Auth::user()->isManajer())
                    <li>
                        <a href="{{ route('stock-opname.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ request()->routeIs('stock-opname.*') ? 'bg-gray-100' : '' }}">Stock Opname</a>
                    </li>
                    @endif
                </ul>
            </li>
            
            @if(Auth::user()->isAdmin() || Auth::user()->isManajer())
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Laporan</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="dropdown-reports" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('reports.stock') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Laporan Stok</a>
                    </li>
                    <li>
                        <a href="{{ route('reports.stock-in') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Laporan Stok Masuk</a>
                    </li>
                    <li>
                        <a href="{{ route('reports.stock-out') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Laporan Stok Keluar</a>
                    </li>
                </ul>
            </li>
            @endif
            
            @if(Auth::user()->isAdmin())
            <li>
                <a href="{{ route('users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('users.*') ? 'bg-gray-100' : '' }}">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="ml-3">Pengguna</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>