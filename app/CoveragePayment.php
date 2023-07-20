<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoveragePayment extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'billing_request' => 'object',
        'billing_request_flow' => 'object',
    ];
}
