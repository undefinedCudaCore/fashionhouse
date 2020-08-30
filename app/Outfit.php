<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    public function outfitMaster()
    {
        return $this->belongsTo('App\Master', 'master_id', 'id');
    }
}
