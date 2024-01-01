<?php

namespace Tests\Unit;

use App\Services\CurrencyService;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_currency_convertor_is_working(): void
    {
        $result = (new CurrencyService)->changeCurrency(100,'usd','eur');
        $this->assertEquals(98,$result);
    }
}
