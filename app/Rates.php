<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    /**
     * 
     *
     * @var string
     */
    protected $table = 'rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['currency_id', 'exchange', 'surcharge', 'surcharge_percent'];
}
