<?php

namespace App\Models;

class Cart
{
    const SESSION_KEY = 'cart';

    /**
     * @param $id
     * @param int $quantity
     * @return mixed
     */
    public static function add($id, $quantity = 1)
    {
        if (!session()->has(self::SESSION_KEY)) {
            session()->put(self::SESSION_KEY, []);
        }

        $key = self::getKeyById($id);
        $newQuantity = session()->get($key, 0) + $quantity;
        session()->put($key, $newQuantity);

        return session()->get(self::SESSION_KEY);
    }

    public static function remove($id, ?int $quantity = null)
    {
        if (session()->has(self::SESSION_KEY)) {
            $key = self::getKeyById($id);
            if (is_null($quantity)) {
                session()->forget($key);
            } else {
                $newQuantity = session()->get($key, 0) - $quantity;
                $newQuantity <=0 ? session()->forget($key) : session()->put($key, $newQuantity);
            }
        }

        return session()->get(self::SESSION_KEY, []);
    }

    /**
     * @return mixed
     */
    public static function clear()
    {
        session()->put(self::SESSION_KEY, []);

        return session()->get(self::SESSION_KEY);
    }

    /**
     * @return array
     */
    public static function getDetail()
    {
        $cartData = session()->get(self::SESSION_KEY, []);
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
    public static function isEmpty()
    {
        return count(session()->get(self::SESSION_KEY, [])) == 0;
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
