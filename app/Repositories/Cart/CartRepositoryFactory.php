<?php

namespace App\Repositories\Cart;

use App\Exceptions\CartException;

class CartRepositoryFactory
{
    /**
     * @param bool $isWeb
     * @return CartRepositoryInterface
     * @throws CartException
     */
    public static function getInstance(bool $isWeb = true)
    {
        if (!app()->runningInConsole()) {
            if ($isWeb) {
                return new CartSessionRepository();
            }
        }

        throw new CartException('Cart repository not found.');
    }
}
