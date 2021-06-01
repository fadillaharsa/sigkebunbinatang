<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function getFacilities(Request $request)
    {
        $facility = new Facility();
        return $facility->getFacilities($request->lat, $request->lng, $request->rad, $request->category)->get();
    }
}
