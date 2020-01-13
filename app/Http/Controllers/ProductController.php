<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Controllers\Traits\CurrencyTrait;

class ProductController extends Controller
{
    use CurrencyTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category')
            ->get();
        $currencies = Currency::all()
            ->keyBy('name');

        return view('admin.products.list',
            array_merge(compact('products', 'currencies'), $this->selectedCurrency())
        );
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Product $product, Request $request)
    {
        $quantity = $request->get('quantity', 1);
        Cart::add($product->id, $quantity);

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart()
    {
        $cart = Cart::getDetail();

        return view('cart.detail',
            array_merge(compact('cart'), $this->selectedCurrency())
        );
    }
}
