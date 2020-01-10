<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = ['USD', 'EUR', 'UAH'];
        $defaultCurrency = config('app.default_currency');

        foreach ($currencies as $currency) {
            $data = ['name' => $currency];
            $insertData = array_merge($data, $defaultCurrency === $currency ? ['conversion_rate' => 1] : []);

            Currency::firstOrCreate($data, $insertData);
        }
    }
}
