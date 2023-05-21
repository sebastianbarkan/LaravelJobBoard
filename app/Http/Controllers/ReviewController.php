<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Listing;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //Create Review
    public function create(Review $review, Listing $listing, User $user, Request $request) {
        $formFields = $request->validate([
            "review" => 'required',
        ]);

        $formFields["user_id"] = auth()->id();
        $formFields["listing_id"] = auth()->id();

        Review::create($formFields);


        return redirect('/')->with('message', 'Review Created Successfully!');
    }
}
