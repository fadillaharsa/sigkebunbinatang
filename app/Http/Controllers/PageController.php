<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
public function home() {
    return view('app.laman.home');
}
public function homePWA() {
    return view('app.laman.homepwa');
}
public function about() {
    return view('app.laman.about');
}
public function ticket() {
    return view('app.laman.ticket');
}
public function contact() {
    return view('app.laman.contact');
}
public function website() {
    return view('app.laman.website');
}
public function guide() {
    return view('app.laman.guide');
}

public function restrict() {
    return view('app.laman.restrict');
}
}
