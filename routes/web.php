<?php

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

use App\Events\FormSubmitted;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/' , function(){

    return view('counter');
});

Route::get('/sender' , function(){

    return view('sender');
});

Route::post('/send' , function(Request $request){

    $message = $request->message;
  
    event( new FormSubmitted($message));
});
