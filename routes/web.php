<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    return view('main', ['message'=>'']);
});

Route::post('/', function (Request $request) {

    

    $sql_query = "insert into users (firstname, lastname, location, field, rate) VALUES (\"{$request->input("firstname")}\" , \"{$request->input("lastname")}\",
     \"{$request->input("location")}\", \"{$request->input("field")}\", {$request->input("rate")});";
     $users = DB::insert($sql_query);
     //return view('main', ['message'=>$sql_query]);
    return view('main', ['message'=>'User added!']);
})->name("addUser");
