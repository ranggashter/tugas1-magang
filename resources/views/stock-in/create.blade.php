@extends('layouts.app')

@section('title', 'Tambah Stok Masuk')

@section('content')
<div class="p-4">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold">Tambah Stok Masuk</h2>
        </div>

        <form action="{{ route('stock-in.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Produk</label>
                    <select name="product_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('product_id') border-red-500 @enderror" required>
                        <option value="">Pilih Produk</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->category->name }}) - Stok: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" min="1"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('quantity') border-red-500 @enderror" 
                           required>
                    @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Satuan (Opsional)</label>
                    <input type="number" name="unit_price" value="{{ old('unit_price') }}" step="0.01" min="0"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('unit_price') border-red-500 @enderror">
                    @error('unit_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('date') border-red-500 @enderror" 
                           required>
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring## 11. Dashboard Views
