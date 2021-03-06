<?php

namespace App\Accounting;

use App\Entities\Invoice;
use App\Entities\Service;
use App\Entities\Transaction;
use App\Entities\User;
use App\Packages\Payment\Facades\Payment;
use App\Packages\Payment\Invoice as PaymentInvoice;

/**
 * Class PaymentCore
 * @package App\Accounting
 */
abstract class PaymentCore
{
    /**
     * @var string $serviceName
     */
    protected $serviceName;

    /**
     * @var Service $service
     */
    protected $service;

    /**
     * @var int $price;
     */
    protected $price;

    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var Invoice $invoice;
     */
    protected $invoice;

    /**
     * @var PaymentInvoice $paymentInvoice
     */
    protected $paymentInvoice;

    /**
     * @var Payment $payment
     */
    protected $payment;

    /**
     * @var string $transactionId
     */
    protected $transactionId;

    /**
     * @var string $paymentLink
     */
    protected $paymentLink;

    /**
     * @var Transaction $transaction
     */
    protected $transaction;

    /**
     * @var bool $success
     */
    protected $success;


    /**
     * PaymentCore constructor.
     */
    public function __construct()
    {
        $this->service = Service::where('title', $this->serviceName)->firstOrFail();
    }


    /**
     * Create Invoice in the Database
     *
     * @return void
     */
    public function createInvoice(): void
    {
        $this->invoice = Invoice::create([
            'price' => $this->price,
            'user_id' => $this->user->id,
            'service_id' => $this->service->id
        ]);

        $this->setPaymentInvoice();
    }

    /**
     * Initialize payment in Payment Provider
     *
     * @return void
     */
    public function initPayment()
    {
        $this->payment = Payment::purchase($this->paymentInvoice);
        $this->setTransactionId();
        $this->createTransaction();
    }

    /**
     * Create Payment Link
     *
     * @return string
     */
    public function paymentLink(): string
    {
        return json_decode($this->payment->pay()->toJson(), true)['action'];
    }

    /**
     * Confirm Payment
     *
     * @param Transaction $transaction
     * @param bool $success
     * @return string
     */
    public function confirmPayment(Transaction $transaction, bool $success)
    {
        $this->setTransaction($transaction);
        $this->success = $success;
        $this->updateTransaction();
    }

    /**
     * $transaction Setter
     *
     * @param Transaction $transaction
     * @return void
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * $transactionId Setter
     *
     * @param string|null $transactionId
     * @return void
     */
    public function setTransactionId(string $transactionId = null)
    {
        $this->transactionId = $transactionId ?? $this->payment->getTransactionId();
    }


    /**
     * $paymentInvoice Setter
     *
     * @return void
     * @throws \Exception
     */
    private function setPaymentInvoice()
    {
        $this->paymentInvoice = (new PaymentInvoice)
            ->amount($this->price)
            ->detail([
                'invoice_id' => $this->invoice->id
            ]);
    }

    /**
     * Create Transaction (Init)
     *
     * @return void
     */
    private function createTransaction()
    {
        $this->transaction = Transaction::create([
            'driver' => $this->payment->getDriver(),
            'price' => $this->price,
            'reference_id' => $this->transactionId,
            'invoice_id' => $this->invoice->id,
        ]);
    }

    /**
     * Update Transaction (Confirm)
     *
     * @return void
     */
    private function updateTransaction()
    {
        $this->transaction = $this->transaction->update([
            'status' => $this->success ? 'SUCCEED' : 'FAILED',
        ]);
    }

}
