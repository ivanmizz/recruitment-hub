<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Listing;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() 
    {
        $companies = Company::count();
        $candidates = User::count();
        $joblistings = Listing::count();
        return view('admin.dashboard', compact('companies', 'candidates', 'joblistings'));
    }
}
