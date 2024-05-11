<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    
    public function showRecruiters() {
        $recruiters = User::where('usertype', 'rec')->paginate(10); 
        return view('admin.users', compact('users'));
    }

    public function showCandidates() {
        $clients = User::where('usertype', 'cnd')->paginate(10); 
        return view('admin.users', compact('users'));
    }
}
