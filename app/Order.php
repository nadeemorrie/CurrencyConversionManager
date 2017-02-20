<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     /**
     * example, pentathlon, masters, heptathlon, senior, U23 ect.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id', 'rate_id', 'amount', 'surcharge', 'total', 'created_at'];
}
