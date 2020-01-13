<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category')
            ->get();
        $currencies = Currency::all()
            ->keyBy('name');

        return view('admin.products.list', compact('products', 'currencies'));
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
}
