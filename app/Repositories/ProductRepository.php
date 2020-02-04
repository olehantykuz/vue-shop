<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * @param int|null $count
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(?int $count = null)
    {
        return Product::with('category')
            ->select(['id', 'name', 'price', 'category_id'])
            ->paginate($count);
    }

    /**
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids)
    {
        return Product::with('category')
            ->whereIn('id', $ids)
            ->get();
    }

}
