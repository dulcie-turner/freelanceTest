<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function display() {
        return view('main', ['message'=>'', 'user_data'=>"test"]);
    }

    public function add_user(Request $request) {
        $user_data = "test";

        // insert user into database
        $sql_query = "insert into users (firstname, lastname, location, field, rate) VALUES (\"{$request->input("firstname")}\" , \"{$request->input("lastname")}\",
         \"{$request->input("location")}\", \"{$request->input("field")}\", {$request->input("rate")});";
        $users = DB::insert($sql_query);

        return view('main', ['message'=>"User added." . "!!", 'user_data'=>$user_data]);
    }
}