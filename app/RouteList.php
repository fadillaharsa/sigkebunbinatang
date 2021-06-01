<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteList extends Model
{
    protected $guarded = [];

    public function facility() {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }

    public function route() {
        return $this->hasMany(Route::class, 'route_id', 'id');
    }
}
