<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Services\CurrencyService;
use Illuminate\Console\Command;

class CurrencyRefreshConversationRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:refresh_conversation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating exchange rates for currencies from the database regarding default currency from configs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        dd(app()->runningInConsole());

        $defaultCurrency = config('app.default_currency');
        $currencies = Currency::where('name', '<>', $defaultCurrency)
            ->get()
            ->pluck('name');

        $currencyService = new CurrencyService($defaultCurrency);
        $conversationRates = $currencyService->getConversationRates($currencies);

        foreach ($conversationRates as $currencyName => $rate)
        {
            Currency::where('name', $currencyName)
                ->update(['conversion_rate' => $rate]);
        }

    }
}
