<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
