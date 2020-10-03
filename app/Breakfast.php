<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breakfast extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'menu_id', 'status', 'bill_type', 'users_count', 'ordered_count', 'total_amount', 'ordered', 'cancelled', 'bulk_cancelled'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'ordered' => 'array',
        'cancelled' => 'array',
        'bulk_cancelled' => 'array'
    ];
}
