<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category', compact('categories'));
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
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Return a view to display the details of a specific category
        return view('admin.category');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categories)
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $categories)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        // Update the category record
        $categories->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
