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
        return view('web.pages.findlocation')->with('title', 'Find Location');
    }

    public function faqs()
    {
        return view('web.pages.faq')->with('title', 'Faqs');
    }

    public function contactUs()
    {
        return view('web.pages.contact-us')->with('title', 'Contact Us');
    }
    // contact submit
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
