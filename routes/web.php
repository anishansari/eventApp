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

Route::get('/', function () {
    $data['events'] = \App\Models\Events::orderBy('start_date', 'ASC')->paginate(20);
    return view('event.index',$data);
});

//events route

Route::resource('event',\App\Http\Controllers\EventController::class);
