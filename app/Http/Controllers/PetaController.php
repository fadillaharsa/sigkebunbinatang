<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;
use App\Animal;
use App\Review;

class PetaController extends Controller
{
public function index() {
    $category = ["Kandang Satwa", "Fasilitas Isoma", "Fasilitas Bermain", "Toilet", "Gerbang"];
    $normal=true;
    return view('app.peta.index',compact('category','normal'));
}

public function filter(Request $request) {
    if($request->category!=null){
        $category=$request->category;
        $normal=false;
        return view('app.peta.index',compact('category','normal'));
    }else{
        $category = [];
        $normal=true;
        return view('app.peta.index',compact('category','normal'));
    }
}

public function showfacility($id) {
    $fasilitas = Facility::where('id',$id)->first();
    $ulasan = Review::where('facility_id',$id)->where('status','1')->latest()->get();
    return view('app.peta.detail', compact('fasilitas','ulasan'));
}

public function direction($id) {
    $fasilitas = Facility::where('id',$id)->first();
    return view('app.peta.direction',compact('fasilitas'));
}

public function review($id) {
    $fasilitas = Facility::select('id','title')->where('id',$id)->first();
    return view('app.peta.review',compact('fasilitas'));
}

public function store(Request $request) {
    $this->validate($request,[
        'facility_id' => ['required'],
        'name' => ['required'],
        'rating' => ['required'],
        'review' => ['required'],
    ]);
    Review::create($request->all());
    $facility_id=$request->facility_id;
    return view('app.peta.thank',compact('facility_id'));
}

public function showanimal($id) {
        $satwa = Animal::where('id',$id)->first();
        return view('app.peta.animal', compact('satwa'));
}
}
