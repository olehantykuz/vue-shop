<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function setCurrency($currency = 'USD')
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = \Validator::make(['currency' => $currency], [
            'currency' => 'required|string|exists:currencies,name',
        ]);
        if ($validator->fails()) {
            return back();
        }

        $selectedCurrency = Currency::where('name', $currency)
            ->first();
        session()->put('currency', [
            'name' => $selectedCurrency ? $selectedCurrency->name : config('app.default'),
            'rate' => $selectedCurrency ? $selectedCurrency->conversion_rate : 1,
        ]);

        return back();
    }
}
