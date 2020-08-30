<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public function masterOutfits()
    {
        return $this->hasMany('App\Outfit', 'master_id', 'id');
    }
}
