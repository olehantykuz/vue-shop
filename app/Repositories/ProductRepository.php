<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    /**
     * @param int|null $count
     * @return LengthAwarePaginator
     */
    public function all(?int $count = null): LengthAwarePaginator
    {
        return $this->getProductsQuery()
            ->paginate($count);
    }

    /**
     * @param array $ids
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids)
    {
        return $this->getProductsQuery()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param string $query
     * @param int|null $count
     * @return LengthAwarePaginator
     */
    public function findByQuery(string $query, ?int $count = null): LengthAwarePaginator
    {
        return $this->getProductsQuery()
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate($count);
    }

    /**
     * @return Builder
     */
    private function getProductsQuery(): Builder
    {
        return Product::with('category')
            ->select(['id', 'name', 'price', 'category_id', 'description']);
    }

}
