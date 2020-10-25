<?php

namespace App\Providers;

use App\Packages\Payment\Payment;
use Illuminate\Support\ServiceProvider;
use App\Packages\Payment\Events\InvoicePurchasedEvent;
use App\Packages\Payment\Events\InvoiceVerifiedEvent;

/**
 * Class PaymentServiceProvider
 * @package App\Providers
 */
class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom('resources/views', 'payment');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bind to service container.
         */
        $this->app->bind('payment', function () {
            $config = config('payment') ?? [];

            return new Payment($config);
        });

        $this->registerEvents();

        // use blade to render redirection form
        Payment::setRedirectionFormViewRenderer(function ($view, $action, $inputs, $method) {
            return view('payment.redirectForm')->with(
                [
                    'action' => $action,
                    'inputs' => $inputs,
                    'method' => $method,
                ]
            );
        });
    }

    /**
     * Register Laravel events.
     *
     * @return void
     */
    public function registerEvents()
    {
        Payment::addPurchaseListener(function ($driver, $invoice) {
            event(new InvoicePurchasedEvent($driver, $invoice));
        });

        Payment::addVerifyListener(function ($reciept, $driver, $invoice) {
            event(new InvoiceVerifiedEvent($reciept, $driver, $invoice));
        });
    }
}
