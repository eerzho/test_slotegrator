<?php

namespace App\Searches\Product;

use App\Models\Product;
use App\Searches\BaseSearch\BaseSearch;

class ProductSearch extends BaseSearch
{
    /**
     * @return string
     */
    protected function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    /**
     * @return string
     */
    protected function getModel(): string
    {
        return Product::class;
    }

    /**
     * @return string[]
     */
    protected function getSorts(): array
    {
        return [
            'id',
            '-id',
            'count',
            '-count',
        ];
    }
}