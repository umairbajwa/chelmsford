<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Coverage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'surname',
        'name',
        'post_code',
        'address_1',
        'address_2',
        'town',
        'county',
        'email',
        'phone_number',
        'referred_by',
        'plan',
        'marketing'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'marketing' => 'boolean',
    ];

    /**
     * Get the payment associated with the Coverage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(CoveragePayment::class, 'coverage_id', 'id');
    }
}
