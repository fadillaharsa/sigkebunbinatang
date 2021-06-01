<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller {

public function __construct()
{
    $this->middleware(['auth']);
}

public function index() {
    $reviews = Review::select('id','review','rating','status')->latest()->get();
    return view('admin.review.index', compact('reviews'));
}

public function create() {
    return view('admin.review.create');
}

public function store(Request $request) {
    $this->validate($request,[
        'facility_id' => ['required'],
        'name' => ['required'],
        'rating' => ['required'],
        'review' => ['required'],
    ]);
    Review::create($request->all());
    return redirect()->route('review.index')->with('status','Ulasan berhasil dibuat.');
}

public function show($id) {
    $review = Review::where('id',$id)->first();
    return view('admin.review.detail', compact('review'));
}

public function edit($id) {
    $review = Review::findOrFail($id);
    if($review->status==1) {
        $review->update(['status'=>'0']);
        return redirect()->route('review.index')->with('status','Ulasan berhasil disembunyikan.');
    } else {
        $review->update(['status'=>'1']);
        return redirect()->route('review.index')->with('status','Ulasan berhasil dipublikasikan.');
    }
}

public function destroy(Request $request) {
    $review = Review::findOrFail($request->id);
    $review->delete();
    return redirect()->route('review.index')->with('status','Ulasan berhasil dihapus.');
}

}
