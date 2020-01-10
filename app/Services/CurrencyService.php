<?php


namespace App\Services;


class CurrencyService
{
    protected $apiUrl = 'https://free.currconv.com/api/v7/convert';
    protected $pairDelimiter = '_';
    protected $apiKey;
    protected $baseCurrency;

    public function __construct($defaultCurrency=null)
    {
        $this->apiKey = config($defaultCurrency ?? 'services.currency.api_key');
        $this->baseCurrency = config('app.default_currency');
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection $currencies
     * @return array
     */
    public function getConversationRates($currencies)
    {
        if (!$this->apiKey) {
            return [];
        }

        $url = $this->apiUrl . '?' . $this->buildQueryString($currencies);
        try {
            $response = json_decode(file_get_contents($url), true);
        } catch (\Exception $e) {

            return [];
        }

        $result = [];
        foreach ($response as $key => $ratio) {
            $currency = $this->getCurrencyNameFromPair($key);
            $result[$currency] = $ratio;
        }

        return $result;
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection $currencies
     * @return string
     */
    protected function buildQueryString($currencies)
    {
        $conversations = [];
        foreach ($currencies as $currency) {
            $conversations[] = $this->baseCurrency . $this->pairDelimiter . $currency;
        }

        $queryParams = [
            'compact' => 'ultra',
            'apiKey' => $this->apiKey,
            'q' => implode(',', $conversations),
        ];

        return http_build_query($queryParams);
    }

    /**
     * @param string $pair
     * @return mixed
     */
    protected function getCurrencyNameFromPair(string $pair)
    {
        return explode($this->pairDelimiter, $pair)[1];
    }

}
