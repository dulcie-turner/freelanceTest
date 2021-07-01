<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $currency = "gbp";
    public $exchange_rate = 1;


    public function display() {
        $user_data = $this->get_user_data();

        return view('main', ['message'=>'', 'user_data'=>$user_data, 'currency'=>strtoupper($this->currency), 'rate'=>$this->exchange_rate]);
    }

    private function add_user(Request $request) {
        $user_data = $this->get_user_data();

        // insert user into database
        $sql_query = "insert into users (firstname, lastname, location, field, rate) VALUES (\"{$request->input("firstname")}\" , \"{$request->input("lastname")}\",
         \"{$request->input("location")}\", \"{$request->input("field")}\", {$request->input("rate")});";
        $users = DB::insert($sql_query);

        return view('main', ['message'=>"User added." , 'user_data'=>$user_data, 'currency'=>strtoupper($this->currency), 'rate'=>$this->exchange_rate]);
    }

    private function get_user_data(){
        $sql_query = "select * from users";
       $users = DB::select($sql_query);
        return $users;
    }

    public function change_currency(Request $request) {
        $user_data = $this->get_user_data();
        $prev_currency = $this->currency;
        $this->currency = $request->input('currency');

        switch ($this->currency) {
            case "gbp":
                $this->exchange_rate = 1;
                break;
            case "usd":
                $this->exchange_rate = 1.3;
                break;
            case "eur":
                $this->exchange_rate = 1.1;
                break;
        }


        return view('main', ['message'=>'Currency changed!', 'user_data'=>$user_data, 'currency'=>strtoupper($this->currency), 'rate'=>$this->exchange_rate]);
    }

    public function form_submit(Request $request) {

        if( $request->has('firstname')) {
            // request is for new user
            return $this->add_user($request);
        } else {
            return $this->change_currency($request);
        }
    }
}