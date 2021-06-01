<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function facility() {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
