<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    public function Hotel() {
        return $this->belongsTo(Hotel::class);
    }

    protected $guarded = [];
}
