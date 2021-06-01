<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $guarded = [];

    public function facility() {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
