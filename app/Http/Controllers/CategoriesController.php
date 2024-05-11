<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::paginate(10);
        return view('admin.categories', compact('categories'));
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
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $categories = new categories;
        $categories->name = $request->name;
        $categories->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        // Return a view to display the details of a specific department
        return view('admin.categories');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        return view('admin.categories');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        // Update the category record
        $categories->update([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        $categories->delete();
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}
