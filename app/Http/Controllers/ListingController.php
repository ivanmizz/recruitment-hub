<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::paginate(10);
        $companies = Company::all();
        $categories = Category::all();
        return view('recruiter.listing', compact('listings', 'companies', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'role_level' => 'required',
            'contract_type' => 'required',
            'type' => 'required',
            'due_date' => 'required',
            'requirement' => 'required',
            'company' => 'required|exists:company,id',
            'user_id' => 'required|exists:user,id',
           
           
        ]);

        $listing = new Company;
        $listing->title = $request->name;
        $listing->description = $request->description;
        $listing->role_level = $request->role_level;
        $listing->contract_type = $request->contract_type;
        $listing->requirement = $request->requirement;
        $listing->type = $request->type;
        $listing->company_id = $request->company;
        $listing->user_id = $request->user_id;
        
        $listing->save();

        return redirect()->back()->with('success', 'Job Listing created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        $listings = Listing::all();
        return view('recruiter.listing', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'role_level' => 'required',
            'contract_type' => 'required',
            'type' => 'required',
            'due_date' => 'required',
            'requirement' => 'required',
            'category_id' => 'required|exists:category,id',
            'company_id' => 'required|exists:company,id',
            'user_id' => 'required|exists:user,id',
              
        ]);

        $listing->update($validatedData);

        return redirect()->back()->with('success', 'listing details updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }

    public function featuredListing() 
    {
        $listings = Listing::where('type', 'premium');
        
    }
}
