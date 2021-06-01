<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $guarded = [];

    public function route() {
        return $this->belongsTo(RouteList::class, 'route_id', 'id');
    }
}
