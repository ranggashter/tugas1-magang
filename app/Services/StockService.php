<?php
// app/Services/StockService.php

namespace App\Services;

use App\Repositories\StockRepository;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StockService
{
    protected $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function stockIn(array $data)
    {
        DB::beginTransaction();
        
        try {
            $stockIn = StockIn::create($data);
            
            if ($data['status'] === 'confirmed') {
                $this->stockRepository->updateProductStock(
                    $data['product_id'], 
                    $data['quantity'], 
                    'in'
                );
            }
            
            DB::commit();
            return $stockIn;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function stockOut(array $data)
    {
        DB::beginTransaction();
        
        try {
            $product = Product::find($data['product_id']);
            
            if ($product->stock < $data['quantity']) {
                throw new \Exception('Stok tidak mencukupi');
            }
            
            $stockOut = StockOut::create($data);
            
            if ($data['status'] === 'confirmed') {
                $this->stockRepository->updateProductStock(
                    $data['product_id'], 
                    $data['quantity'], 
                    'out'
                );
            }
            
            DB::commit();
            return $stockOut;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function stockOpname(array $data)
    {
        DB::beginTransaction();
        
        try {
            $product = Product::find($data['product_id']);
            
            $opnameData = [
                'product_id' => $data['product_id'],
                'user_id' => $data['user_id'],
                'system_stock' => $product->stock,
                'actual_stock' => $data['actual_stock'],
                'difference' => $data['actual_stock'] - $product->stock,
                'date' => $data['date'],
                'note' => $data['note'] ?? null,
            ];
            
            $stockOpname = StockOpname::create($opnameData);
            
            // Update stock produk dengan actual stock
            $product->stock = $data['actual_stock'];
            $product->save();
            
            DB::commit();
            return $stockOpname;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function confirmStockIn($id)
    {
        $stockIn = StockIn::find($id);
        $stockIn->status = 'confirmed';
        $stockIn->save();
        
        $this->stockRepository->updateProductStock(
            $stockIn->product_id, 
            $stockIn->quantity, 
            'in'
        );
        
        return $stockIn;
    }

    public function confirmStockOut($id)
    {
        $stockOut = StockOut::find($id);
        $stockOut->status = 'confirmed';
        $stockOut->save();
        
        $this->stockRepository->updateProductStock(
            $stockOut->product_id, 
            $stockOut->quantity, 
            'out'
        );
        
        return $stockOut;
    }
}