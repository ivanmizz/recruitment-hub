<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Application;
class StripeController extends Controller
{
    public function index() 
    {
       

    }

    public function checkout() 
    {
        return view('checkout');
    }
    public function success() 
    {

    }
}
