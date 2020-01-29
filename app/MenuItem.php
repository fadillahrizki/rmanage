<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }
}
