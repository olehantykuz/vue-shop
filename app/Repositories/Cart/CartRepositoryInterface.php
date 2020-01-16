<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function add($id, int $quantity);
    public function remove($id, int $quantity);
    public function clear();
    public function getDetail();
    public function isEmpty();
}
