<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    public function getPublicDataAttribute($value)
    {
        return json_decode($value);
    }

    public function getPrivateDataAttribute($value)
    {
        return json_decode($value);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
