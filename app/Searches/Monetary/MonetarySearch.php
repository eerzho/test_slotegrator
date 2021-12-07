<?php

namespace App\Searches\Monetary;

use App\Models\Monetary;
use App\Searches\BaseSearch\BaseSearch;

class MonetarySearch extends BaseSearch
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
        return Monetary::class;
    }

    /**
     * @return string[]
     */
    protected function getSorts(): array
    {
        return [
            'id',
            '-id',
            'type',
            '-type',
        ];
    }
}