<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Listing;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;

class ListingController extends Controller
{
    /**
     * Display a listing of jobs for the recruiter.
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
            'query' => 'required|min:2'
        ]);

        // Search companies by name, location, or category
        $listings = Listing::where('title', 'LIKE', "%$query%")
            // ->orWhere('location', 'LIKE', "%$query%")
            // ->orWhere('category', 'LIKE', "%$query%")
            ->paginate(10);

        // Pass the search query and results to the view
        return view('listing.jobs', compact('listings', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$listings = Listing::all();
        $categories = Category::all();
        $companies = Company::where('user_id', Auth::id())->get();
        return view('recruiter.create_listing', compact('categories','companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'role_level' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'due_date' => 'required|date_format:d/m/Y',
            'requirement' => 'required|string',
            'company' => 'required|exists:companies,id',
            'category' => 'required|exists:categories,id',

        ]);

        $listing = new Listing;
        $listing->title = $request->title;
        $listing->description = $request->description;
        $listing->location = $request->location;
        $listing->role_level = $request->role_level;
        $listing->contract_type = $request->contract_type;
        $listing->requirement = $request->requirement;
        $listing->due_date = Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d');
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
     */ public function edit(Listing $listing)
    {
        $listings = Listing::all();
        $categories = Category::all();
        $companies = Company::where('user_id', Auth::id())->get();
        return view('recruiter.edit_listing', compact( 'listings', 'listing', 'companies', 'categories'));
    }


    /**
     * 
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'role_level' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'due_date' => 'required|date_format:d/m/Y',
            'requirement' => 'required|string',
            'company' => 'required|exists:companies,id',
            'category' => 'required|exists:categories,id',

        ]);


        $listing->title = $validatedData['title'];
        $listing->description = $validatedData['description'];
        $listing->location = $validatedData['location'];
        $listing->role_level = $validatedData['role_level'];
        $listing->contract_type = $validatedData['contract_type'];
        $listing->requirement = $validatedData['requirement'];
        $listing->due_date = Carbon::createFromFormat('d/m/Y', $validatedData['due_date'])->format('Y-m-d');
        $listing->company_id = $validatedData['company'];
        $listing->category_id = $validatedData['category'];
       

        $listing->save();
        return redirect()->route('listing.index')->with('success', 'Listing details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->route('listing.index')->with('success', 'Listing deleted successfully.');
    }

     // DISPLAY JOBS LISTINGS FOR THE CANDIDATE
     public function showAllJobs() 
     {
         $listings = Listing::paginate(4);
         return view('listing.jobs', compact('listings'));
     }

    public function showFeaturedJobs()
    {
        //$listings = Listing::where('job_type', 'premium');
        $listings = Listing::all();
        return view('listing.home', compact('listings'));
    }
}
