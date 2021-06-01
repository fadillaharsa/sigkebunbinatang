<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class BeritaController extends Controller
{
public function index() {
    $berita = News::select('id','title','image')->latest()->paginate(10);
    return view('app.berita.index', compact('berita'));
}

public function show($id) {
    $berita = News::where('id',$id)->first();
    return view('app.berita.detail', compact('berita'));
}
}
