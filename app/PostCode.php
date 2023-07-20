<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCode extends Model
{
    protected $table = "post_codes";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'boiler' => 'boolean',
        'quotes' => 'boolean',
    ];
}
