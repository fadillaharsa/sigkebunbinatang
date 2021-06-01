<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model {
protected $guarded = [];
public function animal() {
    return $this->hasMany(Animal::class, 'facility_id', 'id');
}
public function feed() {
    return $this->hasOne(Feed::class, 'facility_id', 'id');
}
public function review() {
    return $this->hasMany(Review::class, 'facility_id', 'id');
}
public function routelist() {
    return $this->hasMany(Animal::class, 'facility_id', 'id');
}
public function getFacilities($latitude, $longitude, $radius, $category) {
    return $this->select('facilities.*')
        ->selectRaw(
            '( 6371 *
                acos( cos( radians(?) ) *
                    cos( radians( latitude ) ) *
                    cos( radians(longitude ) - radians(?)) +
                    sin( radians(?) ) *
                    sin( radians( latitude ) )
                )
            ) AS distance', [$latitude, $longitude, $latitude]
        )
        ->havingRaw("distance < ?", [$radius])
        ->orderBy('distance', 'asc');
}
}
