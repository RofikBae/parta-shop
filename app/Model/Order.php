<?php

namespace App\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
