<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Export\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Exc;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{

    public function export(string $type) {
        if($type == 'xls')
            return Excel::download(new TransactionExport, "transactions.xls", Exc::XLS);
        return Excel::download(new TransactionExport, "transactions.pdf", Exc::TCPDF, []);
    }

}
