<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;

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
        $listings = Listing::where('user_id', Auth::id())->paginate(10);
        $applications = Application::where('listing_id->user_id', Auth::id())->get();
        return view('recruiter.listing', compact('listings', 'applications'));
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
    public function store(Request $request, Listing $listing)
    {

        $validated = $request->validate([
            'candidate_name' => 'required|string|max:50',
            'candidate_email' => 'required|string|max:50',
            'candidate_phone' => 'required|string|max:25',
            'resume' => 'required',
            'message' => 'nullable|max:255',
            'status' => ['required', 'string', Rule::in(['received', 'reviewed', 'shortlisted'])],
            'cover_letter' => 'required|string|max:255',
            'listing' => 'required|exists:listings,id',


        ]);

        $application = new Application;
        $application->candidate_phone = $request->candidate_phone;
        $application->resume = $request->resume;
        $application->message = $request->message;
        $application->status = $request->status;
        $application->cover_letter = $request->cover_letter;
        $application->listing_id = $listing->id;

        if (Auth::check()) {
            $application->user_id = Auth::id();
            $application->candidate_name = auth()->user()->name;
            $application->candidate_email = auth()->user()->email;
        } else {
            $application->candidate_name = $request->candidate_name;
            $application->candidate_email = $request->candidate_email;
        }

        $application->save();

        return redirect()->back()->with('success', 'Application submitted succesfully');


        // try {
        //     $application->save();
        //     return redirect()->back()->with('success', 'Application submitted successfully');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Failed to submit application: ' . $e->getMessage());
        // }
    }

    /**
     * Display the applications for the candidate.
     */
    public function show(Application $application)
    {
        $applications = Application::where('candidate_email', 'user->email')->orWhere('user_id', Auth::id())->get();
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
        $validatedData = $request->validate([
            'message' => 'nullable|max:255',
            'status' => 'nullable|max:255',
        ]);

        $application->status = $validatedData['status'];
        $application->message = $validatedData['message'];


        $application->save();
        return redirect()->back()->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
