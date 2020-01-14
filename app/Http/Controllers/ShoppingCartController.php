<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Http\Controllers\Traits\CurrencyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends Controller
{
    use CurrencyTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (Cart::isEmpty()) {

            return redirect(route('products.list'));
        }
        $cart = Cart::getDetail();

        return view('cart.detail',
            array_merge(compact('cart'), $this->selectedCurrency())
        );
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Product $product, Request $request)
    {
        $this->validator($request->all())->validate();
        $quantity = $request->get('quantity', 1);
        Cart::add($product->id, $quantity);

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clear()
    {
        Cart::clear();

        return redirect(route('products.list'));
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove(Product $product, Request $request)
    {
        $this->validator($request->all())->validate();

        $quantity = $request->get('quantity');
        Cart::remove($product->id, $quantity);

        return redirect(route('cart.detail'));
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'quantity' => 'nullable|integer|min:0',
        ]);
    }
}
