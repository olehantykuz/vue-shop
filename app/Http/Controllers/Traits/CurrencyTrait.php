<?php

namespace App\Http\Controllers\Traits;

trait CurrencyTrait
{
    protected function selectedCurrency()
    {
        return [
            'currencyName' => session()->get('currency.name', 'USD'),
            'currencyRate' => session()->get('currency.rate', 1),
        ];
    }
}
