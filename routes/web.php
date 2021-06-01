<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ADMIN
Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/admin', 'DashboardController@index');
Route::resource('facility', 'FacilityController');
Route::resource('animal', 'AnimalController');
Route::resource('route', 'RouteController');
Route::resource('routelist', 'RouteListController');
Route::get('routelist/createlist/{id}', 'RouteListController@createlist')->name('createlist');
Route::resource('review', 'ReviewController');
Route::resource('news', 'NewsController');

//PENGGUNA
Route::get('/', 'PageController@home')->name('home');
Route::get('/home', 'PageController@homePWA')->name('homePWA');
Route::get('/peta', 'PetaController@index')->name('peta');
Route::post('/peta', 'PetaController@filter')->name('filterpeta');
Route::get('/fasilitas/{id}', 'PetaController@showfacility')->name('lihatfasilitas');
Route::get('/fasilitas/{id}/petunjuk', 'PetaController@direction')->name('petunjukfasilitas');
Route::get('/fasilitas/{id}/ulasan', 'PetaController@review')->name('ulasan');
Route::post('/fasilitas/{id}/ulasan', 'PetaController@store')->name('ulasan');
Route::get('/satwa/{id}', 'PetaController@showanimal')->name('lihatsatwa');
Route::get('/rute', 'RuteController@index')->name('rute');
Route::get('/rute/{route_id}/destinasi/{id}', 'RuteController@show')->name('destinasi');
Route::get('/terima-kasih', 'RuteController@thank')->name('ruteselesai');
Route::get('/wahana', 'WahanaController@index')->name('wahana');
Route::post('/wahana', 'WahanaController@filter')->name('filterwahana');
Route::get('/wahana/{id}', 'WahanaController@show')->name('lihatwahana');
Route::get('/berita', 'BeritaController@index')->name('berita');
Route::get('/berita/{id}', 'BeritaController@show')->name('lihatberita');

Route::get('/galat', 'PageController@restrict')->name('galat');
Route::get('/tentang', 'PageController@about')->name('tentang');
Route::get('/tiket', 'PageController@ticket')->name('tiket');
Route::get('/kontak', 'PageController@contact')->name('kontak');
Route::get('/website', 'PageController@website')->name('website');
Route::get('/guide', 'PageController@guide')->name('guide');

Route::get('/serviceworker.js', function () {
    return response(file_get_contents(asset('/serviceworker.js')), 200, [
    'Content-Type' => 'text/javascript',
    'Cache-Control' => 'public, max-age=3600',
    ]);
});