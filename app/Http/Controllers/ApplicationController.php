<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

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
        return view('recruiter.applications', compact('listings', 'applications'));
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
    // public function store(Request $request)
    // {

    //     $validated = $request->validate([
    //         'candidate_name' => 'required|string|max:50',
    //         'candidate_email' => 'required|string|max:50',
    //         'candidate_phone' => 'required|string|max:25',
    //         'resume' => 'required|file',
    //         'message' => 'nullable|max:255',
    //         'status' => ['required', 'string', Rule::in(['received', 'reviewed', 'shortlisted'])],
    //         'cover_letter' => 'required|string|max:255',
    //         'listing' => 'required|exists:listings,id',


    //     ]);

    //     $application = new Application;
    //     $application->candidate_phone = $request->candidate_phone;
    //     $application->message = $request->message;
    //     $application->status = $request->status;
    //     $application->cover_letter = $request->cover_letter;
    //     $application->listing_id = $request->listing;

    //     if ($request->hasFile('resume')) {
    //         if ($application->resume) {
    //             Storage::disk('public')->delete($application->resume);
    //         }

    //         $filePath = $request->file('resume')->store('resume_docs', 'public');
    //         $application->resume = $filePath;
    //     }

    //     if (Auth::check()) {
    //         $application->user_id = Auth::id();
    //         $application->candidate_name = auth()->user()->name;
    //         $application->candidate_email = auth()->user()->email;
    //     } else {
    //         $application->candidate_name = $request->candidate_name;
    //         $application->candidate_email = $request->candidate_email;
    //     }

    //     $application->save();

    //     return redirect()->back()->with('success', 'Application submitted succesfully');


    //     // try {
    //     //     $application->save();
    //     //     return redirect()->back()->with('success', 'Application submitted successfully');
    //     // } catch (\Exception $e) {
    //     //     return redirect()->back()->with('error', 'Failed to submit application: ' . $e->getMessage());
    //     // }
    // }



    public function store(Request $request)
    {
        Log::info('Store method called.');
    
        try {
            $validated = $request->validate([
                'candidate_name' => 'required|string|max:50',
                'candidate_email' => 'required|string|max:50',
                'candidate_phone' => 'required|string|max:25',
                'resume' => 'required|file',
                'message' => 'nullable|max:255',
                'status' => ['required', 'string', Rule::in(['received', 'reviewed', 'shortlisted'])],
                'listing' => 'required|exists:listings,id',
            ]);
    
            Log::info('Validation passed.', $validated);
    
            $application = new Application;
            $application->candidate_phone = $request->candidate_phone;
            $application->message = $request->message;
            $application->status = $request->status;
            $application->cover_letter = $request->cover_letter;
            $application->listing_id = $request->listing;
    
            Log::info('Application object created.', ['listing_id' => $request->listing]);
    
            if ($request->hasFile('resume')) {
                Log::info('Resume file detected.');
                if ($application->resume) {
                    Storage::disk('public')->delete($application->resume);
                }
    
                $filePath = $request->file('resume')->store('resume_docs', 'public');
                $application->resume = $filePath;
                Log::info('Resume uploaded.', ['path' => $filePath]);
            }
    
            if (Auth::check()) {
                $application->user_id = Auth::id();
                $application->candidate_name = auth()->user()->name;
                $application->candidate_email = auth()->user()->email;
                Log::info('User authenticated.', ['user_id' => $application->user_id]);
            } else {
                $application->candidate_name = $request->candidate_name;
                $application->candidate_email = $request->candidate_email;
                Log::info('User not authenticated.', ['candidate_name' => $application->candidate_name, 'candidate_email' => $application->candidate_email]);
            }
    
            $saved = $application->save();
    
            if ($saved) {
                Log::info('Application saved successfully.');
            } else {
                Log::error('Application save failed.');
            }
    
            return redirect()->back()->with('success', 'Application submitted successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed.', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred.', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
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
