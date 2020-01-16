<?php

namespace App\Repositories\Cart;

use App\Models\Product;

class CartSessionRepository implements CartRepositoryInterface
{
    const SESSION_KEY = 'cart';

    public function __construct()
    {
        if (!session()->has(self::SESSION_KEY)) {
            session()->put(self::SESSION_KEY, []);
        }
    }

    /**
     * @param $id
     * @param int $quantity
     * @return mixed
     */
    public function add($id, int $quantity = 1)
    {
        $key = self::getKeyById($id);
        $newQuantity = session()->get($key, 0) + $quantity;
        session()->put($key, $newQuantity);

        return session()->get(self::SESSION_KEY);
    }

    /**
     * @param $id
     * @param int|null $quantity
     * @return mixed
     */
    public function remove($id, int $quantity = null)
    {
        $key = self::getKeyById($id);
        if (is_null($quantity)) {
            session()->forget($key);
        } else {
            $newQuantity = session()->get($key, 0) - $quantity;
            $newQuantity <= 0 ? session()->forget($key) : session()->put($key, $newQuantity);
        }

        return $this->get();
    }

    /**
     * @return mixed
     */
    public function clear()
    {
        session()->put(self::SESSION_KEY, []);

        return session()->get(self::SESSION_KEY);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return session()->get(self::SESSION_KEY, []);
    }

    /**
     * @return array
     */
    public function getDetail()
    {
        $cartData = $this->get();
        $result = [
            'items' => [],
            'total' => 0,
        ];

        if ($cartData) {
            $ids = array_keys($cartData);
            $products = Product::whereIn('id', $ids)
                ->with('category')
                ->get()
                ->keyBy('id');

            foreach ($cartData as $id => $count) {
                $product = $products[$id];

                $result['items'][] = [
                    'product' => $product,
                    'quantity' => $count,
                ];
                $result['total'] += $product->price * $count;
            }
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return count($this->get()) == 0;
    }

    /**
     * @param $id
     * @return string
     */
    protected static function getKeyById($id)
    {
        return self::SESSION_KEY . '.' . $id;
    }

}
