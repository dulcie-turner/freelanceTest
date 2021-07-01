<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function display() {
        $user_data = $this->get_user_data();

        return view('main', ['message'=>'', 'user_data'=>$user_data]);
    }

    public function add_user(Request $request) {
        $user_data = $this->get_user_data();

        // insert user into database
        $sql_query = "insert into users (firstname, lastname, location, field, rate) VALUES (\"{$request->input("firstname")}\" , \"{$request->input("lastname")}\",
         \"{$request->input("location")}\", \"{$request->input("field")}\", {$request->input("rate")});";
        $users = DB::insert($sql_query);

        return view('main', ['message'=>"User added." . "!!", 'user_data'=>$user_data]);
    }

    private function get_user_data(){
        $sql_query = "select * from users";
       $users = DB::select($sql_query);
        return $users;
    }

    public function change_currency() {
        
    }
}