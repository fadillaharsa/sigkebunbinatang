<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{

public function __construct() {
    $this->middleware(['auth']);
}

public function index() {
    $routes = Route::select('id','name')->latest()->get();
    return view('admin.route.index',compact('routes'));
}

public function create() {
    return view('admin.route.create');
}

public function store(Request $request) {
    $this->validate($request,[
        'name' => ['required'],
        'description' => ['required'],
        'duration' => ['required'],
    ]);
    Route::create($request->all());
    return redirect()->route('route.index')->with('status','Rute berhasil dibuat.');
}

public function show($id)
{
    //
}

public function edit($id) {
    $route = Route::findOrFail($id);
    return view('admin.route.edit', compact('route'));
}

public function update(Request $request, $id) {
    $route = Route::findOrFail($id);
    $this->validate($request,[
        'name' => ['required'],
        'description' => ['required'],
        'duration' => ['required'],
    ]);
    $route->update($request->all());
    return redirect()->route('route.index')->with('status','Rute berhasil diubah.');
}

public function destroy(Request $request) {
    $route = Route::findOrFail($request->id);
    $route->delete();
    return redirect()->route('route.index')->with('status','Rute berhasil dihapus.');
}

}
