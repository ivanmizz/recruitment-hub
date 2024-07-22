<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$companies = Company::with('category')->paginate(10);
        $companies = Company::where('user_id', Auth::id())->paginate(10);
        $categories = Category::all();
        return view('recruiter.company', compact('companies', 'categories'));
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
        $companies = Company::where('name', 'LIKE', "%$query%")
             ->orWhere('location', 'LIKE', "%$query%")
             ->orWhereHas('categories', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            }) ->paginate(4);

        // Pass the search query and results to the view
        return view('listing.companies', compact('companies', 'query'));
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

        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'logo' => 'nullable|mimes:jpeg,png,jpg|max:1024',
           
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->description = $request->description;
        $company->category_id = $request->category;
        $company->location = $request->location;
        $company->user_id = Auth::id();



        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $imagePath = $request->file('logo')->store('company_logo', 'public');
            $company->logo = $imagePath;
        }

        $company->save();

        return redirect()->back()->with('success', 'Company added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $categories = Category::all();
        return view('recruiter.company', compact('company', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'logo' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            
        ]);

        $company->name = $validatedData['name'];
        $company->description = $validatedData['description'];
        $company->category_id = $validatedData['category'];
        $company->location = $validatedData['location'];

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $imagePath = $request->file('logo')->store('company_logo', 'public');
            $company->logo = $imagePath;
        }

        $company->save();

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }

    public function showAllCompanies() 
     {
         $companies = Company::paginate(5);
         return view('listing.companies', compact('companies'));
     }


    //   A LISTING OF COMPANIES FOR THE ADMIN 
     public function showCompanies()
    {
        //$companies = Company::with('category')->paginate(10);
        $companies = Company::paginate(10);
        $categories = Category::all();
        return view('admin.company', compact('companies', 'categories'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'Company deleted successfully.');
    }
}
