<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'driver',
        'price',
        'reference_id',
        'invoice_id',
        'tracking_code',
        'card_number',
        'status',
        'paid_at',
        'description',
    ];

    public function logs()
    {
        return $this->hasMany(TransactionLog::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
