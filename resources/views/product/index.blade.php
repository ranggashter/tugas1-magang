@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="p-4">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold">Daftar Produk</h2>
                @if(Auth::user()->isAdmin() || Auth::user()->isManajer())
                <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Produk
                </a>
                @endif
            </div>

            <!-- Search Form -->
            <div class="mt-4">
                <form method="GET" action="{{ route('products.index') }}" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari produk atau SKU..." 
                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cari
                    </button>
                    @if(request('search'))
                    <a href="{{ route('products.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Reset
                    </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($product->image)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-600 text-sm">{{ substr($product->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">SKU: {{ $product->sku }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $product->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $product->supplier->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>Beli: Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</div>
                            <div>Jual: Rp {{ number_format($product->sale_price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $product->isLowStock() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $product->stock }} pcs
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                            @if(Auth::user()->isAdmin() || Auth::user()->isManajer())
                            <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data produk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection