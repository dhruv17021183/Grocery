<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'item_id',
    ];
    public function items()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
