<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsEmail;
use App\Models\contactUs;
use App\Models\TrackingRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    public function home()
    {
        return view('web.pages.index')->with('title', 'Home');
    }
    
    public function findLocation()
    {
        $stripeKey = config('services.stripe.key');
        return view('web.pages.findlocation', compact('stripeKey'))->with('title','Find Location',);
    }

    public function faqs()
    {
        return view('web.pages.faq')->with('title', 'Faqs');
    }

    public function contactUs()
    {
        return view('web.pages.contact-us')->with('title', 'Contact Us');
    }

    public function checkout()
    {
        return view('web.pages.checkout')->with('title', 'Payment Successful');
    }

    public function checkouterror()
    {
        return view('web.pages.checkouterror')->with('title', 'Payment Error');
    }

    public function contactFormSubmission(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:512',
        'message' => 'required|string',
    ]);

    $create = contactUs::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'userIP' => Auth::check() ? Auth::id() : $request->ip(),
    ]);

    // Mail to admin
    Mail::to(env('Admin_Email', 'admin@example.com'))->send(new ContactUsEmail($create));

    return back()->with('message', 'Your message has been sent successfully!');
}



   }
