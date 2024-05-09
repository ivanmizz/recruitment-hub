<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{

    public function redirect() {
        if(Auth::id()) {
            if(Auth::user()->usertype=='cnd') {
                return view('candidate.home');
            } 
            elseif(Auth::user()->usertype=='rec') {
                return view('recruiter.home');
            }
            else {
                return view('admin.dashboard');
            }
        }
        else {
            return redirect()->back();
        }
    }
}
