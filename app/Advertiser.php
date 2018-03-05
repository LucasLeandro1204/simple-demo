<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertiser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'address',
    ];

    /**
     * The adds from advertiser.
     */
    public function adss(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
