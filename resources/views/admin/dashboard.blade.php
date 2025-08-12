@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 bg-opacity-75">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ $totalProducts }}</h2>
                    <p class="text-gray-600">Total Produk</p>
                </div>
            </div>
        </div>

        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 bg-opacity-75">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1# Stockify - Sistem Manajemen Stok Barang
                         <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ $totalSuppliers }}</h2>
                    <p class="text-gray-600">Total Supplier</p>
                </div>
            </div>
        </div>

        <div class="border-2 border-dashed border-red-300 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 bg-opacity-75">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">{{ $lowStockProducts }}</h2>
                    <p class="text-gray-600">Stok Menipis</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Recent Stock In -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Stok Masuk Terbaru</h3>
            <div class="space-y-3">
                @forelse($recentStockIns as $stockIn)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-medium">{{ $stockIn->product->name }}</p>
                        <p class="text-sm text-gray-600">{{ $stockIn->quantity }} pcs - {{ $stockIn->date->format('d/m/Y') }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $stockIn->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($stockIn->status) }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500">Belum ada data stok masuk</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Stock Out -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Stok Keluar Terbaru</h3>
            <div class="space-y-3">
                @forelse($recentStockOuts as $stockOut)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-medium">{{ $stockOut->product->name }}</p>
                        <p class="text-sm text-gray-600">{{ $stockOut->quantity }} pcs - {{ $stockOut->date->format('d/m/Y') }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $stockOut->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($stockOut->status) }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500">Belum ada data stok keluar</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection