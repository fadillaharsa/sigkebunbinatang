<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

class WahanaController extends Controller
{
public function index() {
    $wahana = Feed::latest()->get();
    return view('app.wahana.index', compact('wahana'));
}

public function show($id) {
    $wahana = Feed::where('id',$id)->first();
    return view('app.wahana.detail', compact('wahana'));
}

public function filter(Request $request) {
    if($request->category!=null){
        $filter=$request->category;
        $wahana = Feed::whereIn('category',$request->category)->latest()->get();
        return view('app.wahana.index', compact('wahana','filter'));
    }else{
        $wahana = Feed::latest()->get();
        return view('app.wahana.index', compact('wahana'));
    }
}
}
