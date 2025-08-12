<?php
// app/Http/Controllers/StockController.php

namespace App\Http\Controllers;

use App\Services\StockService;
use App\Http\Requests\StockInRequest;
use App\Http\Requests\StockOutRequest;
use App\Http\Requests\StockOpnameRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    // Stock In Methods
    public function stockInIndex()
    {
        $stockIns = $this->stockService->getStockInHistory();
        return view('stock.stock-in.index', compact('stockIns'));
    }

    public function stockInCreate()
    {
        $products = Product::all();
        return view('stock.stock-in.create', compact('products'));
    }

    public function stockInStore(StockInRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            
            $this->stockService->stockIn($data);
            
            return redirect()->route('stock-in.index')
                ->with('success', 'Transaksi stok masuk berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan stok masuk: ' . $e->getMessage());
        }
    }

    // Stock Out Methods
    public function stockOutIndex()
    {
        $stockOuts = $this->stockService->getStockOutHistory();
        return view('stock.stock-out.index', compact('stockOuts'));
    }

    public function stockOutCreate()
    {
        $products = Product::all();
        return view('stock.stock-out.create', compact('products'));
    }

    public function stockOutStore(StockOutRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            
            $this->stockService->stockOut($data);
            
            return redirect()->route('stock-out.index')
                ->with('success', 'Transaksi stok keluar berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan stok keluar: ' . $e->getMessage());
        }
    }

    // Stock Opname Methods
    public function stockOpnameIndex()
    {
        $stockOpnames = $this->stockService->getStockOpnameHistory();
        return view('stock.stock-opname.index', compact('stockOpnames'));
    }

    public function stockOpnameCreate()
    {
        $products = Product::all();
        return view('stock.stock-opname.create', compact('products'));
    }

    public function stockOpnameStore(StockOpnameRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            
            $this->stockService->stockOpname($data);
            
            return redirect()->route('stock-opname.index')
                ->with('success', 'Stock opname berhasil dilakukan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal melakukan stock opname: ' . $e->getMessage());
        }
    }
}