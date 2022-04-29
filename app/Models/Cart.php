<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','item_id'];
    public function items()
    {
        return $this->belongsTo('App\Models\Item');
    }
    
}
