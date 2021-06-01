<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Route;
use App\Facility;
use App\RouteList;

class RuteController extends Controller
{
public function index() {
    $rute = Route::get();
    $routelist = RouteList::where('order',1)->get();
    return view('app.rute.index', compact('rute','routelist'));
}

public function show(Request $request, $route_id, $id) {
    $jumlah = RouteList::where('route_id',$route_id)->count();
    $destinasi = RouteList::where('route_id',$route_id)->where('order',$id)->first();
    $routelist = RouteList::where('route_id',$route_id)->where('order',$id+1)->first();
    return view('app.rute.detail', compact('destinasi', 'jumlah','routelist'));
}

public function thank() {
    return view('app.rute.thank');
}
}
