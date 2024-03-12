<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class HomeController extends Controller
{

    public function index(Request $request){
        $title = "Домашняя страница";
        return view('home', compact('title'));
    }

}
