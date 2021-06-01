<?php


namespace App\Http\Controllers;
use App\Route;
use App\RouteList;
use App\Facility;
use Illuminate\Http\Request;

class RouteListController extends Controller
{
public function index($id)
{

}

public function createlist($id) {
    $select = Facility::pluck('title', 'id');
    $route_id = $id;
    return view('admin.routelist.create',compact('route_id','select'));
}

public function store(Request $request) {
    $this->validate($request,[
        'route_id' => ['required'],
        'facility_id' => ['required'],
    ]);
    $count = RouteList::where('route_id',$request->route_id)->count();
    RouteList::create([
        'route_id' => $request->route_id,
        'facility_id' => $request->facility_id,
        'order'=>$count+1
    ]);
    return redirect()->route('routelist.show',$request->route_id)->with('status','List rute berhasil dibuat.');
}

public function show($id) {
    $route = Route::findOrFail($id);
    $routelist = RouteList::where('route_id',$id)->select('id','order','facility_id')->orderBy('order', 'DESC')->get();
    return view('admin.routelist.index', compact('route','routelist'));
}

public function edit($id) {
    $routelist = RouteList::findOrFail($id);
    $route_id = $id;
    $select = Facility::pluck('title', 'id');
    return view('admin.routelist.edit', compact('route_id','routelist','select'));
}

public function update(Request $request, $id) {
    $routelist = RouteList::findOrFail($id);
    $this->validate($request,[
        'facility_id' => ['required'],
    ]);
    $routelist->update([
        'facility_id' => $request->facility_id,
    ]);
    return redirect()->route('routelist.show',$routelist->route_id)->with('status','List rute berhasil diubah.');
}

public function destroy(Request $request) {
    $routelist = RouteList::findOrFail($request->id);
    $routelist->delete();
    return redirect()->route('routelist.show',$request->idrute)->with('status','List rute berhasil dihapus.');
}

}
