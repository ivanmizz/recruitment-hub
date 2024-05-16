<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        $category = Category::paginate(10);
        return view ('recruiter.company', compact('companies', 'category'));
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:category,id',
            'location' => 'required',
            'logo' => 'mimes:jpeg,png,jpg|max:2048',
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->description = $request->description;
        $company->category = $request->category;
        $company->location = $request->location;

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $imagePath = $request->file('image')->store('company_logo', 'public');
            $company->logo = $imagePath;
        }

        $company->save($validatedData);

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
        $company = Company::all();
        $category = Category::all();
        return view('recruiter.company', compact('company','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:category,id',
            'location' => 'required',
            'logo' => 'mimes:jpeg,png,jpg|max:2048',
        ]);

        $company->update($validatedData);
        
        return redirect()->route('admin.company')->with('success', 'Company details updated successfully.');

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
