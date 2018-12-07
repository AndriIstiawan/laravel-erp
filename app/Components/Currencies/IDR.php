<?php

namespace App\Components\Currencies;

use SSD\Currency\Currencies\BaseCurrency;

class IDR extends BaseCurrency
{
    /**
     * @var string
     */
    protected $prefix = 'Rp';

    /**
     * @var string
     */
    protected $postfix = 'IDR';
}
