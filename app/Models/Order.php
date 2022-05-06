<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'qty',
        'address',
        'states',
        'pincode',
        'user_id',
        'item_id',
    ];
    public function user()
    {
        $this->belongsTo('App\Model\User');
    }
    public function items()
    {
        $this->belongsTo('App\Models\Item');
    }

}
