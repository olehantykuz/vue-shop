<?php


namespace App\Services;


class CurrencyService
{
    protected $apiUrl = 'https://free.currconv.com/api/v7/convert';
    protected $pairDelimiter = '_';
    protected $apiKey;
    protected $baseCurrency;

    protected $queryParams = [
        'compact' => 'ultra',
        'apiKey' => null,
        'q' => null,
    ];

    public function __construct()
    {
        $this->apiKey = config('services.currency.api_key');
        $this->baseCurrency = config('app.default_currency');
    }

    /**
     * @param array $currencies
     * @return array
     * @throws \Exception
     */
    public function getConversationRates(array $currencies)
    {
        if (!$this->apiKey) {
            throw new \Exception('apiKey required');
        }

        $url = $this->apiUrl . '?' . $this->buildQueryString($currencies);
        $response = json_decode(file_get_contents($url), true);
        $result = [];

        foreach ($response as $key => $ratio) {
            $currency = $this->getCurrencyNameFromPair($key);
            $result[$currency] = $ratio;
        }

        return $result;
    }

    /**
     * @param array $currencies
     * @return string
     */
    protected function buildQueryString(array $currencies)
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
