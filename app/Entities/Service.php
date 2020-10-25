<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{

    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'class',
        'is_active'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
