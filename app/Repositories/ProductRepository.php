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

}
