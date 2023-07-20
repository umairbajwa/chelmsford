<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table = "quotes";
    protected $appends = ['total_quoted_price'];

    public function getTotalQuotedPriceAttribute()
    {
        $price = unserialize($this->quoted_price);
        $total = 0;
        if(isset($price['default'])){
            $total += $price['default'];
        }
        if(isset($price['water'])){
            $total += $price['water'];
        }
        if(isset($price[0])){
            $total += $price[0];
        }
        return $total;
    }
}
