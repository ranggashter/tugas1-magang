<?php
// app/Repositories/ProductRepository.php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function withRelations()
    {
        return $this->model->with(['category', 'supplier']);
    }

    public function findWithRelations($id)
    {
        return $this->model->with(['category', 'supplier'])->find($id);
    }

    public function getLowStockProducts()
    {
        return $this->model->whereRaw('stock <= min_stock')->with(['category', 'supplier'])->get();
    }

    public function searchProducts($search)
    {
        return $this->model->where('name', 'like', "%{$search}%")
            ->orWhere('sku', 'like', "%{$search}%")
            ->with(['category', 'supplier'])
            ->paginate(10);
    }
}