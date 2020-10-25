<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{

    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'user_id',
        'service_id',
        'status'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
