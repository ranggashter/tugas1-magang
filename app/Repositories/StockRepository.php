<?php
// app/Repositories/StockRepository.php

namespace App\Repositories;

use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;
use App\Models\Product;

class StockRepository
{
    public function getStockInHistory($productId = null)
    {
        $query = StockIn::with(['product', 'user']);
        
        if ($productId) {
            $query->where('product_id', $productId);
        }
        
        return $query->orderBy('date', 'desc')->paginate(15);
    }

    public function getStockOutHistory($productId = null)
    {
        $query = StockOut::with(['product', 'user']);
        
        if ($productId) {
            $query->where('product_id', $productId);
        }
        
        return $query->orderBy('date', 'desc')->paginate(15);
    }

    public function getStockOpnameHistory($productId = null)
    {
        $query = StockOpname::with(['product', 'user']);
        
        if ($productId) {
            $query->where('product_id', $productId);
        }
        
        return $query->orderBy('date', 'desc')->paginate(15);
    }

    public function updateProductStock($productId, $quantity, $type = 'in')
    {
        $product = Product::find($productId);
        
        if ($type === 'in') {
            $product->stock += $quantity;
        } else {
            $product->stock -= $quantity;
        }
        
        $product->save();
        return $product;
    }
}