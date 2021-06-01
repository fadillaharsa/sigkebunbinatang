<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class NewsController extends Controller {

public function __construct()
{
    $this->middleware(['auth']);
}

public function index() {
    $news = News::select('id','title')->latest()->get();
    return view('admin.news.index', compact('news'));
}

public function create() {
    return view('admin.news.create');
}

public function store(Request $request) {
    $this->validate($request,[
        'title' => ['required'],
        'image' => ['required','mimes:jpg,png'],
        'content' => ['required'],
    ]);
    $imageName = time().'.'.$request->image->getClientOriginalExtension();
    $request->image->storeAs('public/news', $imageName);
    $imagePath = "news/".$imageName;  
    News::create([
        'user_id' => Auth::user()->id,
        'title' => $request->title,
        'image' => $imagePath,
        'content' => $request->content,
    ]);
    return redirect()->route('news.index')->with('status','Berita berhasil dibuat.');
}

public function show($id)
{
    //
}

public function edit($id) {
    $news = News::findOrFail($id);
    return view('admin.news.edit', compact('news'));
}

public function update(Request $request, $id) {
    $news = News::findOrFail($id);
    $this->validate($request,[
        'title' => ['required'],
        'image' => ['mimes:jpg,png'],
        'content' => ['required'],
    ]);
    $news->update($request->except('image'));
    if($request->has('image')){
        Storage::delete('public/'.$news->image);
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->storeAs('public/news', $imageName);
        $imagePath = "news/".$imageName; 
        $news->update(['image'=>$imagePath]);
    };
    return redirect()->route('news.index')->with('status','Berita berhasil diubah.');
}

public function destroy(Request $request) {
    $news = News::findOrFail($request->id);
    Storage::delete('public/'.$news->image);
    $news->delete();
    return redirect()->route('news.index')->with('status','Berita berhasil dihapus.');
}

}
