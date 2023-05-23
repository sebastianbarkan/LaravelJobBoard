<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    //Manage Listing
    public function manage(Listing $listing, Request $request, Application $application) {

        return view("applications.manage", [
            "applications" => auth()->user()->applications()->get(),
        ]);
    }
}
