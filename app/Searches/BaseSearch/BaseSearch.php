<?php

namespace App\Searches\BaseSearch;

use App\Components\Dto;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property Builder $builder
 * @property array   $searches
 * @property string  $sort
 */
abstract class BaseSearch
{
    private Builder $builder;
    private array $searches;
    private ?string $sort;

    /**
     * @return string
     */
    abstract protected function getNamespace(): string;

    /**
     * @return string
     */
    abstract protected function getModel(): string;

    /**
     * @return array
     */
    abstract protected function getSorts(): array;

    /**
     * @param Dto $request
     */
    public function __construct(Dto $request)
    {
        $this->builder = $this->getModel()::query();
        $this->searches = $request->get('search', []);
        $this->sort = $request->get('sort');
    }

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->applyDecoratorsFromRequest();
    }

    /**
     * @return Builder
     */
    private function applyDecoratorsFromRequest(): Builder
    {
        foreach ($this->searches as $filterName => $value) {

            if (class_exists($decorator = $this->createFilterDecorator($filterName))) {
                $this->builder = $decorator::apply($this->builder, $value);

            } elseif (class_exists($decorator = $this->createFilterDecorator($filterName, true))) {
                $this->builder = $decorator::apply($this->builder, $value);
            }
        }

        if (in_array($this->sort, $this->getSorts())) {

            if ($isDesc = str_starts_with($this->sort, '-')) {
                $this->sort = substr($this->sort, 1, strlen($this->sort));
            }

            $this->builder->orderBy($this->sort, $isDesc ? 'desc' : 'asc');
        }

        return $this->builder;
    }

    /**
     * @param string $name
     * @param bool   $default
     *
     * @return string
     */
    private function createFilterDecorator(string $name, bool $default = false): string
    {
        $name = str_replace('_', '', mb_convert_case($name, MB_CASE_TITLE, "UTF-8"));
        return ($default ? __NAMESPACE__ : $this->getNamespace()) . '\\Filters\\' . $name;
    }
}
