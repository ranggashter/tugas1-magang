<?php
// app/Services/ProductService.php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->withRelations()->paginate(15);
    }

    public function getProductById($id)
    {
        return $this->productRepository->findWithRelations($id);
    }

    public function createProduct(array $data)
    {
        $data['sku'] = $this->generateSKU($data['name']);
        
        if (isset($data['image'])) {
            $data['image'] = $this->handleImageUpload($data['image']);
        }

        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->handleImageUpload($data['image']);
        }

        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getLowStockProducts()
    {
        return $this->productRepository->getLowStockProducts();
    }

    private function generateSKU($name)
    {
        $prefix = strtoupper(substr($name, 0, 3));
        $suffix = strtoupper(Str::random(3));
        return $prefix . '-' . time() . '-' . $suffix;
    }

    private function handleImageUpload($image)
    {
        return $image->store('products', 'public');
    }
}