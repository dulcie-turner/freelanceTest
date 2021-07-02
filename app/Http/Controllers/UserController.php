<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public $currency = "gbp";
    public $exchange_rate = 1;

    public function display()
    {
        // display main page
        $user_data = $this->get_user_data();

        return view('main', ['message' => '', 'user_data' => $user_data, 'currency' => strtoupper($this->currency), 'rate' => $this->exchange_rate]);
    }

    private function add_user(Request $request)
    {
        $user_data = $this->get_user_data();

        // insert user into database
        $sql_query = "insert into users (firstname, lastname, location, field, rate) VALUES (\"{$request->input("firstname")}\" , \"{$request->input("lastname")}\",
         \"{$request->input("location")}\", \"{$request->input("field")}\", {$request->input("rate")});";
        $users = DB::insert($sql_query);

        return view('main', ['message' => "User added.", 'user_data' => $user_data, 'currency' => strtoupper($this->currency), 'rate' => $this->exchange_rate]);
    }

    private function get_user_data()
    {
        // get all user data from db
        $sql_query = "select * from users";
        $users = DB::select($sql_query);
        return $users;
    }

    private function local_rate($currency)
    {
        // find the local exchange rate for selected currency
        switch ($currency) {
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
    }

    private function third_party_rate($currency)
    {
        // use fixer api to find most recent exchange rate for currency

        // get all 3 rates from api
        $guzzle_client = new Client(['base_uri' => 'http://data.fixer.io/api']);
        $response = $guzzle_client->get('/latest', ['query' => ['access_key' => 'd6d3c2c6ad64e7615e26626ed3e12759', 'symbols' => "gbp, eur, usd"]]);
        $json_response = json_decode($response->getBody());

        // base currency fixed at euro by fixer
        switch ($currency) {
            case "gbp":
                $this->exchange_rate = 1;
                break;
            case "usd":
                // divide by eur -> gbp rate then multiply by eur -> usd
                $this->exchange_rate = round($json_response->rates->USD / $json_response->rates->GBP, 2);
                break;
            case "eur":
                // divide by eur -> gbp rate
                $this->exchange_rate = round(1.0 / $json_response->rates->GBP, 2);
                break;
        }
    }

    public function change_currency(Request $request)
    {
        $user_data = $this->get_user_data();

        // handle changing the exchange rate
        $this->currency = $request->input('currency');
        if ($request->input('rate_type') == 'local') {
            $this->local_rate($this->currency);
        } else {
            $this->third_party_rate($this->currency);
        }

        return view('main', ['message' => '', 'user_data' => $user_data, 'currency' => strtoupper($this->currency), 'rate' => $this->exchange_rate]);
    }

    public function form_submit(Request $request)
    {
        // handle form being submitted

        if ($request->has('firstname')) {
            // request is for new user
            return $this->add_user($request);
        } else {
            // request is to change currency
            return $this->change_currency($request);
        }
    }
}
