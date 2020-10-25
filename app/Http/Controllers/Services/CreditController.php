<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Services\Credit;
use Illuminate\Http\Request;

/**
 * Class PaymentController
 * @package App\Http\Controllers\Services
 */
class CreditController extends Controller
{

    public function index() {
        return view('services.credit.index');
    }

    public function increase(Request $request) {
        $data = $this->validate($request, [
            'amount' => ['required', 'numeric', 'min:10000'],
        ]);

        return redirect(
            (new Credit())->init([
                'price' => (int) $data['amount']
            ])
        );
    }

}
