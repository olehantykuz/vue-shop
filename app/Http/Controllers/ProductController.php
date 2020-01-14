<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\CurrencyTrait;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductService;

class ProductController extends Controller
{
    use CurrencyTrait;

    /**
     * @param ProductService $service
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductService $service, Request $request)
    {
        /** @var \Illuminate\Contracts\Validation\Validator $validator */
        $validator = Validator::make($request->all(), [
            'count' => 'nullable|integer|min:1',
        ]);
        $validator->validate();

        $products = $service->all($request->get('count'));
        $currencies = Currency::pluck('conversion_rate', 'name');

        return view('admin.products.list',
            array_merge(compact('products', 'currencies'), $this->selectedCurrency())
        );
    }

}
