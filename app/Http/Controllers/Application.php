<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Application extends Controller
{
    //
    
    //Manage Listing
    public function manage() {
        return view("applications.manage", ["applications" => auth()->user()->applications()->get()]);
    }
}
