<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Controllers\BaseController\BaseController;
use App\Models\Product;
use App\Searches\Product\ProductSearch;
use App\Services\Product\ProductStoreService;

class ProductController extends BaseController
{
    public function index()
    {
        $builder = (new ProductSearch(new Dto(request()->get('query'))))->getQuery();
        self::sendOutput($builder->get()->toArray());
    }

    public function store()
    {
        $data = request()->get('body');

        new Validator([
            'name'        => ['required', 'str', 'min:3', 'max:255'],
            'description' => ['required', 'str', 'min:3', 'max:255'],
            'count'       => ['required', 'int', 'min:2', 'max:200'],
        ], $data);

        $product = new Product();
        $isSave = (new ProductStoreService($product, new Dto($data)))->run();

        if ($isSave) {
            self::sendOutput($product->toArray());
        } else {
            self::sendError(ErrorMessage::CREATE, 400);
        }
    }

    public function show(array $attributes)
    {
        $product = Product::findOne($attributes['id']);

        self::sendOutput($product->toArray());
    }
}