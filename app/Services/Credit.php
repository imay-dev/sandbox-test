<?php

namespace App\Services;

use App\Accounting\PaymentCore;
use Illuminate\Support\Facades\Auth;

/**
 * Class Credit
 * @package App\Services
 */
class Credit extends PaymentCore implements ServiceInterface
{
    /**
     * Credit constructor.
     */
    public function __construct()
    {
        $this->serviceName = 'credit';
        $this->user = Auth::user();

        parent::__construct();
    }

    /**
     * @param null $args
     * @return string
     */
    public function init($args = null): string
    {
        $this->price = $args['price'];
        $this->createInvoice();
        $this->initPayment();
        return $this->paymentLink;
    }

    /**
     * @param null $args
     * @return mixed|void
     */
    public function confirm($args = null)
    {
        // TODO: Implement confirm() method.
    }
}
