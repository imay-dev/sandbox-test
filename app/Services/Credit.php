<?php

namespace App\Services;

use App\Accounting\PaymentCore;
use App\Entities\Transaction;
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
        return $this->paymentLink();
    }

    /**
     * @param Transaction $transaction
     * @param bool $success
     *
     * @return mixed|void
     */
    public function confirm(Transaction $transaction, bool $success)
    {
        $this->confirmPayment($transaction, $success);

        if ($success) {
            $transaction->invoice->update([
                'status' => 'PAID'
            ]);
            $transaction->invoice->user->update([
                'credit' => $transaction->invoice->user->credit + $transaction->price
            ]);
            $transaction->invoice->update([
                'status' => 'SUCCESS'
            ]);
        }
    }
}
