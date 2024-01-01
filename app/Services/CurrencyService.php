<?php

namespace App\Services;


class CurrencyService
{

    private $currencies = [
        'usd'   => [
            'eur'   => 0.98,
        ],
    ];

    public function changeCurrency($amount,$from,$to)
    {
        return $amount * $this->currencies[$from][$to];
    }
}
