<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'item_content',
        'item_category',
        'price',
        'status',
        'user_id',
        'item_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function order()
    {
        return $this->hasMany('App\Models\Order')->latest();
    }
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image','imageable');
    }
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
