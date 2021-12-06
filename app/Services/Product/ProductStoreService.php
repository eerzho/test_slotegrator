<?php

namespace App\Services\Product;

use App\Components\Dto;
use App\Models\Product;

/**
 * @property Product $product
 * @property Dto     $data
 */
class ProductStoreService
{
    private Product $product;
    private Dto $data;

    /**
     * @param Product $product
     * @param Dto     $data
     */
    public function __construct(Product $product, Dto $data)
    {
        $this->product = $product;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function run()
    {
        $this->product->name = $this->data->get('name');
        $this->product->description = $this->data->get('description');
        $this->product->count = $this->data->get('count');

        return $this->product->save();
    }
}