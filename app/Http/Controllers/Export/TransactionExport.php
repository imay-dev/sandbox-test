<?php

namespace App\Http\Controllers\Export;

use App\Entities\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Class TransactionExport
 * @package App\Http\Controllers\Export
 */
class TransactionExport implements FromCollection
{
    /**
     * @return Transaction[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::all();
    }
}
