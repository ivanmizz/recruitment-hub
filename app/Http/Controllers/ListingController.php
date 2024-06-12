<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Listing;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::where('user_id', Auth::id())->paginate(10);
        $companies = Company::paginate(10);
        $categories = Category::all();
        return view('recruiter.listing', compact('listings', 'companies', 'categories'));
    }

    /**
     * Search for companies 
     */
    public function search(Request $request)
{
    $query = $request->input('query');

    // Validate the search query
    $request->validate([
        'query' => 'required|min:3'
    ]);

    // Search companies by name, location, or description
    $listings = Company::where('title', 'LIKE', "%$query%")
                        ->orWhere('location', 'LIKE', "%$query%")
                        ->orWhere('category', 'LIKE', "%$query%")
                        ->orWhere('contract_type', 'LIKE', "%$query%")
                        ->paginate(10);

    // Pass the search query and results to the view
    return view('listing.index', compact('listings', 'query'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        $categories = Category::all();
        $companies = Company::where('user_id', Auth::id())->get();
        return view('recruiter.create_listing', compact('categories', 'companies'));
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
            'job_type' => 'required',
            'due_date' => 'required',
            'requirement' => 'required',
            'company' => 'required|exists:company,id',
            'category' => 'required|exists:categories,id',    
           
        ]);

        $listing = new Company;
        $listing->title = $request->name;
        $listing->description = $request->description;
        $listing->role_level = $request->role_level;
        $listing->contract_type = $request->contract_type;
        $listing->requirement = $request->requirement;
        $listing->job_type = $request->job_type;
        $listing->company_id = $request->company;
        $listing->category_id = $request->category;
        $listing->user_id = Auth::id();
        
        $listing->save();

        return redirect()->back()->with('success', 'Job Listing created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        $listings = Listing::all();
        return view('recruiter.edit_listing', compact('listings'));
    }

    /**
     * 
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'role_level' => 'required',
            'contract_type' => 'required',
            'job_type' => 'required',
            'due_date' => 'required',
            'requirement' => 'required',
            'category_id' => 'required|exists:category,id',
            'company_id' => 'required|exists:company,id',
              
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
        $premiumlisting = Listing::where('job_type', 'premium');
        return view('featuredlisting', compact('premiumlisting'));
        
    }
}
