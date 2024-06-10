<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\Listing;

class HomeController extends Controller
{

    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 'cnd') {
                return view('candidate.home');
            } elseif (Auth::user()->usertype == 'rec') {
                return view('recruiter.home');
            } else {

                $companies = Company::count();
                $candidates = User::count();
                $joblistings = Listing::count();
                return view('admin.dashboard', compact('companies', 'candidates', 'joblistings'));
            }
        } else {
            return redirect()->back();
        }
    }

    
}
