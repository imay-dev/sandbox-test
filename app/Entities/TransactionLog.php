<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;


class TransactionLog extends Model
{
    protected $table = 'transaction_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'result_code',
        'result_message',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
