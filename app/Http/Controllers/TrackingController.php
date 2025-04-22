<?php

namespace App\Http\Controllers;

use App\Mail\TrackingRequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\TrackingRequest;

class TrackingController extends Controller
{
    public function showTrackingForm()
    {
        return view('dashboard.pages.send_request')->with('title', 'Tracking Request');
    }

    public function sendTrackingRequest(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $token = Str::random(60);

        TrackingRequest::create([
            'user_id' => Auth::id(),
            'target_user_email' => $request->email,
            'token' => $token,
            'status' => 'pending',
        ]);

        Mail::to($request->email)->send(new TrackingRequestEmail($token));
        return back()->with('message', 'Tracking request sent successfully!');
    }

    public function approveTrackingRequest($token)
    {
        $trackingRequest = TrackingRequest::where('token', $token)->firstOrFail();
        return view('dashboard.pages.get_location', compact('trackingRequest'))->with('title', 'Get Location');
    }

    public function saveLocation(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'latitude' => 'required_if:denied,false',
            'longitude' => 'required_if:denied,false',
        ]);

        $trackingRequest = TrackingRequest::where('token', $request->token)->firstOrFail();

        if (!$trackingRequest) {
            return response()->json(['message' => 'Invalid tracking token.'], 404);
        }

        if ($request->denied == true) {
            $trackingRequest->update([
                'status' => 'cancelled',
            ]);
            return response()->json(['message' => 'Location access denied. Tracking cancelled.']);
        }

        if ($trackingRequest->status === 'pending' || $trackingRequest->status === 'cancelled') {
            $trackingRequest->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => 'active',
            ]);
        } else {
            $trackingRequest->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }

        return response()->json(['message' => 'Location saved successfully.']);
    }


    public function cancelTrackingByToken(Request $request)
    {
        $request->validate(['token' => 'required']);
        $trackingRequest = TrackingRequest::where('token', $request->token)->first();

        if ($trackingRequest && $trackingRequest->status === 'pending') {
            $trackingRequest->update(['status' => 'cancelled']);
            return response()->json(['message' => 'Tracking request cancelled.']);
        }

        return response()->json(['message' => 'Tracking request not found or already processed.'], 404);
    }


    public function trackUser($id)
    {
        $tracking = TrackingRequest::findOrFail($id);
        return view('dashboard.pages.track', [
            'latitude' => $tracking->latitude,
            'longitude' => $tracking->longitude,
            'email' => $tracking->target_user_email,
        ])->with('title', 'Track User');
    }

    public function trackingHistory()
    {
        $user = Auth::user();
        if ($user->role_id == '1') {
            $trackingRequests = TrackingRequest::where('is_active', 1)->where('is_deleted', 0)->paginate(10);
        } else {
            $trackingRequests = TrackingRequest::where('user_id', $user->id)->where('is_active', 1)->where('is_deleted', 0)->paginate(10);
        }
        return view('dashboard.pages.tracking_history', compact('trackingRequests'))->with('title', 'Tracking History');
    }
}
