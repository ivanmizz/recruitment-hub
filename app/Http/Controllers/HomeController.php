<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\Listing;
use App\Models\Application;

class HomeController extends Controller
{

    public function redirect()
    {
        if (Auth::id()) {  
            if (Auth::user()->usertype == 'cnd') {
                $applications = Application::where('user_id', Auth::id())->count();
                return view('candidate.home', compact('applications'));

            } elseif (Auth::user()->usertype == 'rec') {

               
                $companies = Company::where('user_id', Auth::id())->count();
                $applications = Application::whereRelation('listing', 'user_id', Auth::id())->count();
                $joblistings = Listing::where('user_id', Auth::id())->count();
                return view('recruiter.home', compact('companies', 'applications', 'joblistings'));

            } else {

                $companies = Company::count();
                $admins = User::where('usertype', 'adm')->count();
                $candidates = User::where('usertype', 'cnd')->count();
                $recruiters = User::where('usertype', 'rec')->count();
                $joblistings = Listing::count();
                return view('admin.dashboard', compact('companies', 'admins', 'candidates', 'recruiters', 'joblistings'));
            }

        } else {

            return redirect()->back();
        }
    }
}
