<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
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

}
