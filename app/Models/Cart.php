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
        if(!session()->has(self::SESSION_KEY)) {
            session()->put(self::SESSION_KEY, []);
        }

        $key = self::getKeyById($id);
        $newQuantity = session()->get($key, 0) + $quantity;
        session()->put($key, $newQuantity);

        return session()->get(self::SESSION_KEY);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function remove($id)
    {
        if(session()->has(self::SESSION_KEY)) {
            session()->forget(self::getKeyById($id));
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
     * @param $id
     * @return string
     */
    protected static function getKeyById($id)
    {
        return self::SESSION_KEY . '.' . $id;
    }
}
