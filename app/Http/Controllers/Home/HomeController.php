<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __invoke(Request $request)
    {
        $cities = [
            [
                'country_code' => 'GB',
                'name'         => 'London'
            ],
            [
                'country_code' => 'GB',
                'name'         => 'Liverpool'
            ]
        ];

        return view('home', ['cities' => $cities]);
    }
}
