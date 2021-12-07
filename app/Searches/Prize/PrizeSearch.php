<?php

namespace App\Searches\Prize;

use App\Models\Prize;
use App\Searches\BaseSearch\BaseSearch;

class PrizeSearch extends BaseSearch
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
        return Prize::class;
    }

    /**
     * @return string[]
     */
    protected function getSorts(): array
    {
        return [
            'id',
            '-id',
        ];
    }
}