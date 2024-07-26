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
        $userId = Auth::id();
        $applications = Application::whereHas('listing',
        function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->paginate(10);
        return view('recruiter.applications', compact('applications'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate the search query
        $request->validate([
            'query' => 'required|min:2'
        ]);

        // Search applicatoin by candidate name, listing title, status or message
        $applications = Application::where('candidate_name', 'LIKE', "%$query%")
             ->orWhere('status', 'LIKE', "%$query%")
             ->orWhere('message', 'LIKE', "%$query%")
             ->orWhereHas('listing', function ($q) use ($query) {
                $q->where('title', 'LIKE', "%$query%");
            })->paginate(5);

        // Pass the search query and results to the view
        return view('recruiter.applications', compact('applications', 'query'));
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

        $validated = $request->validate([
            'candidate_name' => 'required|string|max:50',
            'candidate_email' => 'required|string|max:50',
            'candidate_phone' => 'required|string|max:25',
            'resume' => 'required|file',
            'message' => 'nullable|max:255',
            'status' => ['required', 'string', Rule::in(['received', 'reviewed', 'shortlisted'])],
            'cover_letter' => 'required|string|max:255',
            'listing' => 'required|exists:listings,id',


        ]);

        $application = new Application;
        $application->candidate_phone = $request->candidate_phone;
        $application->message = $request->message;
        $application->status = $request->status;
        $application->cover_letter = $request->cover_letter;
        $application->listing_id = $request->listing;

        if ($request->hasFile('resume')) {
            if ($application->resume) {
                Storage::disk('public')->delete($application->resume);
            }

            $filePath = $request->file('resume')->store('resume_docs', 'public');
            $application->resume = $filePath;
        }

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
        $validated = $request->validate([
            'message' => 'nullable|max:255',
            'status' => 'nullable|max:255',
        ]);

        $application->status = $validated['status'];
        $application->message = $validated['message'];

        if(auth()->user()->usertype == 'cnd') 
        {
            $application->user_id = Auth::id();
        }

        $application->save();
        return redirect()->back()->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->back()->with('success', 'Listing deleted successfully.');
    }
}
