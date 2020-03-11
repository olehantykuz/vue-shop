<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    /**
     * @param int|null $count
     * @return LengthAwarePaginator
     */
    public function all(?int $count = null)
    {
        return $this->repository
            ->all($count);
    }

    /**
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getListByIds(array $ids)
    {
        return $this->repository
            ->getByIds($ids);
    }

    /**
     * @param string $query
     * @param int|null $count
     * @return LengthAwarePaginator
     */
    public function searchByQuery(string $query, ?int $count = null)
    {
        return $this->repository
            ->findByQuery($query, $count);
    }

}
