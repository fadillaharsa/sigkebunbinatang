<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller{

public function __construct() {
    $this->middleware(['auth']);
}

public function index() {
    $facilities = Facility::select('id','title','code')->with('feed')->latest()->get();
    return view('admin.facility.index', compact('facilities'));
}

public function create() {
    return view('admin.facility.create');
}

public function store(Request $request) {

    $this->validate($request,[
        'title' => ['required'],
        'code' => ['required','unique:facilities,code'],
        'photo' => ['required','mimes:jpg,png'],
        'description' => ['required'],
        'category' => ['required'],
        'latitude' => ['required'],
        'longitude' => ['required'],
        'icon' => ['required','mimes:jpg,png'],
    ]);
    if($request->isFeed==1) {
        $this->validate($request,[
            'categoryFeed' => ['required'],
            'price' => ['required'],
            'descriptionFeed' => ['required'],
        ]);
    };
    $photoName = time().'.'.$request->photo->getClientOriginalExtension();
    $request->photo->storeAs('public/facilities', $photoName);
    $photoPath = "facilities/".$photoName;  
    $iconName = time().'.'.$request->icon->getClientOriginalExtension();
    $request->icon->storeAs('public/icons', $iconName);
    $iconPath = "icons/".$iconName;  
    $facility = Facility::create([
        'title' => $request->title,
        'code' => $request->code,
        'description' => $request->description,
        'category' => $request->category,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'icon' => $iconPath,
        'photo' => $photoPath,
    ]);
    if($request->isFeed==1) {
        $facility->feed()->create([
            'facility_id' => $facility->id,
            'category' => $request->categoryFeed,
            'price' => $request->price,
            'description' => $request->descriptionFeed,
        ]);
    }
    return redirect()->route('facility.index')->with('status','Fasilitas berhasil dibuat.');
}

public function edit($id) {
    $facility = Facility::findOrFail($id);
    $feed = Feed::where('facility_id',$id)->first();
    return view('admin.facility.edit', compact('facility','feed'));
}

public function update(Request $request, $id) {
    $facility = Facility::findOrFail($id);
    $this->validate($request,[
        'title' => ['required'],
        'code' => ['required'],
        'photo' => ['mimes:jpg,png'],
        'description' => ['required'],
        'category' => ['required'],
        'latitude' => ['required'],
        'longitude' => ['required'],
        'icon' => ['mimes:jpg,png'],
    ]);
    if($request->isFeed==1) {
        $this->validate($request,[
            'categoryFeed' => ['required'],
            'price' => ['required'],
            'descriptionFeed' => ['required'],
        ]);
    }
    $facility->update($request->except('photo','icon','isFeed','categoryFeed','price','descriptionFeed'));
    if($request->has('photo')) {
        Storage::delete('public/'.$facility->photo);
        $photoName = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->storeAs('public/facilities', $photoName);
        $photoPath = "facilities/".$photoName; 
        $facility->update(['photo'=>$photoPath]);
    };
    if($request->has('icon')) {
        Storage::delete('public/'.$facility->icon);
        $iconName = time().'.'.$request->icon->getClientOriginalExtension();
        $request->icon->storeAs('public/icons', $iconName);
        $iconPath = "icons/".$iconName; 
        $facility->update(['icon'=>$iconPath]);
    };
    if($request->isFeed==1) {
        $facility->feed()->update([
            'category' => $request->categoryFeed,
            'price' => $request->price,
            'description' => $request->descriptionFeed,
        ]);
    }
    return redirect()->route('facility.index')->with('status','Fasilitas berhasil diubah.');
}

public function destroy(Request $request) {
    $facility = Facility::findOrFail($request->id);
    Storage::delete('public/'.$facility->photo);
    Storage::delete('public/'.$facility->icon);
    $feed = Feed::where('facility_id',$request->id)->first();
    if($feed!=null) {
        $facility->feed()->delete();
    }
    $facility->delete();
    return redirect()->route('facility.index')->with('status','Fasilitas berhasil dihapus.');
}

}
