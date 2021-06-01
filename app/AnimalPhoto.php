<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalPhoto extends Model
{
protected $guarded = [];
public function animal() {
    return $this->belongsTo(Animal::class, 'animal_id', 'id');
}
}
