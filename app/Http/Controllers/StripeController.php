<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Application;
use Stripe\Stripe;
use Stripe\Charge;
class StripeController extends Controller
{
    public function showPaymentForm($listingId)
    {
        $listing = Listing::findOrFail($listingId);
        return view('recruiter.show_listing', compact('listing'));
    }

    public function processPayment(Request $request)
    {
        $listingId = $request->input('listing_id');
        $listing = Listing::findOrFail($listingId);

        
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create the charge on Stripe's servers
            $charge = Charge::create([
                'amount' => 100, 
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Sponsored listing for: ' . $listing->title,
            ]);
             if ($listing->job_type === 'free') {
                $listing->job_type = 'premium';
                $listing->save();
    
                return redirect()->back()->with('success', 'Payment succesful!');
             } 
           
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error processing payment: ' . $e->getMessage()]);
        }
    }
}
