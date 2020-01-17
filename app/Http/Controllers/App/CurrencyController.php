<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::select('name', 'conversion_rate')
            ->get();

        return response()->json($currencies, 200);
    }
}
