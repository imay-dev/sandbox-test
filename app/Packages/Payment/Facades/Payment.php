<?php

namespace App\Packages\Payment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Payment
 * @package App\Packages\Payment\Facades
 */
class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'payment';
    }
}
