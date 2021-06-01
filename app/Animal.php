<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
protected $guarded = [];
public function photos() {
    return $this->hasMany(AnimalPhoto::class, 'animal_id', 'id');
}
public function facility() {
    return $this->belongsTo(Facility::class, 'facility_id', 'id');
}
}
