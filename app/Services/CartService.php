<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryFactory;

class CartService
{
    /** @var \App\Repositories\Cart\CartRepositoryInterface */
    protected $repository;

    public function __construct()
    {
        $this->repository = CartRepositoryFactory::getInstance();
    }


}
