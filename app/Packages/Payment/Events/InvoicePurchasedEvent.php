<?php

namespace App\Packages\Payment\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Packages\Payment\Contracts\DriverInterface;
use App\Packages\Payment\Invoice;

class InvoicePurchasedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $driver;
    public $invoice;

    /**
     * InvoicePurchasedEvent constructor.
     *
     * @param DriverInterface $driver
     * @param Invoice $invoice
     */
    public function __construct(DriverInterface $driver, Invoice $invoice)
    {
        $this->driver = $driver;
        $this->invoice = $invoice;
    }
}
