<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function menuItems(){
        return $this->hasMany(MenuItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }    
}
