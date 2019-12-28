<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function HotelRoom() {
        return $this->hasMany(HotelRoom::class);
    }
}
