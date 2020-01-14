<?php

namespace App\Http\Controllers\Traits;

trait CurrencyTrait
{
    protected function selectedCurrency()
    {
        return [
            'currencyName' => session()->get('currency.name', config('app.default_currency')),
            'currencyRate' => session()->get('currency.rate', 1),
        ];
    }
}
