<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    protected $table = "products";
    protected $appends = ['product_type', 'updated_price'];

    public function getProductTypeAttribute()
    {
        $value = '';
        switch ($this->iscombi) {
            case '1':
                $value = 'Combi Boiler';
                break;
            case '2':
                $value = 'Combi Storage Boiler';
                break;
            case '3':
                $value = 'Open Vent Boiler';
                break;
            case '4':
                $value = 'System Boiler';
                break;
            case '5':
                $value = 'Water Cylinder';
                break;
            case '6':
                $value = 'Boost a main';
                break;
        }

        return $value;
    }

    /**
     * Get the Updated Price
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedPriceAttribute()
    {
        $expiry = $this->global_value_expiry;
        if ($expiry && strtotime($expiry) < strtotime(date('Y-m-d'))) {
            DB::table('products')->update(['global_value_expiry' => NULL, 'global_value_percentage' => 0]);
            $expiry = NULL;
        }
        $product = Products::find($this->id);
        $productPrice = $product->price;
        $valuePercentage = $product->global_value_percentage && $product->global_value_percentage > 0 ?  $product->global_value_percentage : ($product->value_percentage && $product->value_percentage > 0 ? $product->value_percentage : false);
        $valueType = $product->global_value_percentage && $product->global_value_percentage > 0 ?  $product->global_value_type : ($product->value_percentage && $product->value_percentage > 0 ? $product->value_type : false);
        if ($valuePercentage) {
            if ($valueType == 'Increase') {
                $productPrice += (($productPrice / 100) * $valuePercentage);
            } else {
                $productPrice -= (($productPrice / 100) * $valuePercentage);
            }
        }
        return $productPrice;
    }
}
