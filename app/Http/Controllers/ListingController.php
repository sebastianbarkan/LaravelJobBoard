<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Listing;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show/get all listings
    public function index() {
        return view('listings.index', [
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->paginate(6)
        ]);
    }

    //Show single listing
    public function show(Listing $listing, Review $review, User $user) {
        return view("listings.show", [
            "listing" => $listing,
            "reviews" => Review::latest()->where("listing_id", $listing->id)->paginate(6),
        ]);
    }

    //show create form
    public function create() {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {

        $formFields = $request->validate([
            "title" => 'required',
            'company' => ["required", Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ["required", "email"],
            "tags" => 'required',
            "description" => "required"
        ]);

        if($request->hasFile("logo")) {
            $formFields['logo'] = $request->file('logo')->store("logos", "public");
        }

        $formFields["user_id"] = auth()->id();

        Listing::create($formFields);


        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    //Show edit form
    public function edit(Listing $listing) {

        return view("listings.edit", ["listing" => $listing]);
    }



    //Update listing data
    public function update(Request $request, Listing $listing) {

        //make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized action");
        }

        $formFields = $request->validate([
            "title" => 'required',
            'company' => ["required"],
            'location' => 'required',
            'website' => 'required',
            'email' => ["required", "email"],
            "tags" => 'required',
            "description" => "required"
        ]);

        if($request->hasFile("logo")) {
            $formFields['logo'] = $request->file('logo')->store("logos", "public");
        }

        $listing->update($formFields);


            return back()->with('message', 'Listing Updated Successfully!');
        }

        //Delete listing
        public function destroy(Listing $listing) {

            //make sure logged in user is owner
            if($listing->user_id != auth()->id()) {
                abort(403, "Unauthorized action");
            }

            $listing->delete();
            return redirect("/")->with("message", "Listing Deleted Successfully");
        }

        //Manage Listing
        public function manage() {
            return view("listings.manage", ["listings" => auth()->user()->listings()->get()]);
        }

        //Apply to Listing
        public function apply(Request $request, Listing $listing) {
            $formFields = $request->validate([
                "name" => 'required',
            ]);
    
            if($request->hasFile("resume")) {
                $formFields['resume'] = $request->file('resume')->store("resumes", "public");

            }
    

            $formFields["company"] = $listing->title;        
            $formFields["user_id"] = auth()->id();
            $formFields["listing_id"] = $listing->id;

            Application::create($formFields);

            return back()->with('message', 'Applied Successfully!');

        }

}