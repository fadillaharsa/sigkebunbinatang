<?php

namespace App\Http\Controllers;

use App\Animal;
use App\AnimalPhoto;
use App\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
public function __construct()
{
    $this->middleware(['auth']);
}

public function index() {
    $facilities = Facility::select('id')->get()->count();
    $animals = Animal::select('id','name','facility_id')->latest()->get();
    return view('admin.animal.index', compact('animals','facilities'));
}

public function create() {
    $select = Facility::pluck('title', 'id');
    return view('admin.animal.create',compact('select'));
}

public function store(Request $request) {
    $this->validate($request,[
        'name' => ['required'],
        'latin' => ['required'],
        'facility_id' => ['required'],
        'description' => ['required'],
        'photo' => ['required',],
        'photo.*' => ['mimes:jpg,png'],
    ]);
    $animal = Animal::create($request->except('photo'));
    $animalPhotos = [];
    foreach ($request->file('photo') as $file) {
        $path = Storage::disk('public')->putFile('animals', $file);
        $animalPhotos[] = [
            'animal_id' => $animal->id,
            'path' => $path
        ];
    }
    $animal->photos()->insert($animalPhotos);
    return redirect()->route('animal.index')->with('status','Satwa berhasil ditambahkan.');
}

public function show($id)
{
    //
}

public function edit($id) {
    $select = Facility::pluck('title', 'id');
    $animal = Animal::findOrFail($id);
    $animal->select('id','facility_id','name','description')->with('photos');
    return view('admin.animal.edit', compact('animal','select'));
}

public function update(Request $request, $id) {
    $animal = Animal::findOrFail($id);
    $this->validate($request,[
        'name' => ['required'],
        'latin' => ['required'],
        'facility_id' => ['required'],
        'description' => ['required'],
    ]);
    if($request->has('photo')) {
        foreach ($animal->photos as $photo) {
            Storage::delete('public/'.$photo->path);
        }
        $animalPhotos = AnimalPhoto::where('animal_id',$id);
        $animalPhotos->delete();
    }
    $animal->update($request->except('photo'));
    if($request->has('photo')) {
        $animalPhotos = [];
        foreach ($request->file('photo') as $file) {
            $path = Storage::disk('public')->putFile('animals', $file);
            $animalPhotos[] = [
                'animal_id' => $animal->id,
                'path' => $path
            ];
        }
        $animal->photos()->insert($animalPhotos);
    };
    return redirect()->route('animal.index')->with('status','Satwa berhasil diubah.');
}

public function destroy(Request $request) {
    $animal = Animal::findOrFail($request->id);
    foreach ($animal->photos as $photo) {
        Storage::delete('public/'.$photo->path);
    }
    $animal->delete();
    return redirect()->route('animal.index')->with('status','Satwa berhasil dihapus.');
}
}
