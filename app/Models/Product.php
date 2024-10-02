<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'delivery_type',
        'delivery_period',
        'price',
        'public_data',
        'private_data',
        'seller_id',
        'status',
    ];

    public function getPublicDataAttribute($value)
    {
        return json_decode($value);
    }

    public function getPrivateDataAttribute($value)
    {
        return json_decode($value);
    }


    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
