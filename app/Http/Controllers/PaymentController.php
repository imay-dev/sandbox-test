<?php

namespace App\Http\Controllers;


use App\Entities\Transaction;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{

    public function confirm() {
        $success = request()->get('Status') == 'OK';
        $transaction = Transaction::getByReference(request()->get('Authority'));
        $service = $transaction->invoice->service;
        $serviceClass = $service->class;
        (new $serviceClass())->confirm($transaction, $success);

        $message = $success ? "Your {$service->title} has been paid successfully." : "Something went wrong in the payment process.";
        return redirect(route('home'))->with($success ? 'success' : 'failure', $message);
    }

}
