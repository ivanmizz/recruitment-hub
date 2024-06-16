<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications for the recruiter.
     */
    public function index()
    {
        $listings = Listing::where('user_id', Auth::id())->get();
        $applications = Application::where('listing_id->user_id', Auth::id())->get();
        return view('recruiter.application', compact('listings', 'applications'));
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
        //
    }

    /**
     * Display the applications for the candidate.
     */
    public function show(Application $application)
    {
        $applications = Application::where('email', 'user->email')->get();
        return view('candidate.application', compact('applications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
