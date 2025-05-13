<?php

namespace App\Http\Controllers;

use App\Mail\TrackingRequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\TrackingRequest;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Log;

class TrackingController extends Controller
{
    public function trackingRequests(Request $request)
    {
        $user = Auth::user();
        $status = $request->get('status', 'active');

        $query = TrackingRequest::with('user')
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('status', $status);

        if ($user->role_id != '1') {
            $query->where('user_id', $user->id);
        }

        $trackingRequests = $query->orderByDesc('id')->paginate(10);

        return view('dashboard.pages.tracking-requests', compact('trackingRequests', 'status'))->with('title', 'Tracking Request');
    }

    public function trackingRequestsForm()
    {
        return view('dashboard.pages.send_request')->with('title', 'Send Tracking Request');
    }

    // public function sendTrackingRequest(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);
    //     $token = Str::random(60);

    //     TrackingRequest::create([
    //         'user_id' => Auth::id(),
    //         'target_user_email' => $request->email,
    //         'token' => $token,
    //         'status' => 'pending',
    //     ]);

    //     Mail::to($request->email)->send(new TrackingRequestEmail($token));
    //     return back()->with('message', 'Tracking request sent successfully!');
    // }

    public function sendTrackingRequest(Request $request)
    {
        // Dynamically set the validation rules
        $rules = [
            'methods' => 'required|array|min:1',
            'message' => 'nullable|string',
        ];

        if (in_array('sms', $request->methods) || in_array('whatsapp', $request->methods)) {
            $rules['contact_number'] = 'required|string';
        }

        if (in_array('email', $request->methods)) {
            $rules['email'] = 'required|email|string';
        }

        $request->validate($rules);

        try {
            $user = Auth::user();
            $token = Str::random(60);
            $methods = $request->methods;
            $contactNumber = $request->contact_number;
            $email = $request->email;
            $message = $request->message ?? 'You are being tracked. Click to approve location sharing.';

            // Store the tracking request
            $trackingRequest = TrackingRequest::create([
                'user_id' => $user->id,
                'target_user_email' => $email ?? null,
                'token' => $token,
                'status' => 'pending',
                'contact_number' => $contactNumber ?? null,
                'message' => $message,
                'methods' => json_encode($methods),
            ]);

            $trackingLink = route('approve.tracking.request', $token);
            $fullMessage = $message . "\nClick here to approve: " . $trackingLink;

            $twilio = new TwilioService();
            // Send via selected methods
            foreach ($methods as $method) {
                if ($method === 'sms') {

                    // Simulate SMS sending (for example, with Twilio)
                    $twilio->sendSMS($contactNumber, $fullMessage);
                    logger("Sending SMS to {$contactNumber}: {$fullMessage}");
                }

                if ($method === 'whatsapp') {
                    // Simulate WhatsApp sending (for example, with Twilio)
                    $twilio->sendWhatsApp($contactNumber, $fullMessage);
                    logger("Sending WhatsApp to {$contactNumber}: {$fullMessage}");
                }

                if ($method === 'email') {
                    if (!$email) {
                        return back()->withErrors(['email' => 'Email is required if Email method is selected.']);
                    }
                    $trackingRequest->update(['target_user_email' => $email]);
                    Mail::to($email)->send(new TrackingRequestEmail($token));
                }
            }

            // Redirect back with success message
            return back()->with('message', 'Tracking request sent successfully via selected method(s).');
        } catch (\Exception $e) {
            Log::error('Error while sending tracking request: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return back()->withInput()->with('error', $e->getMessage());
        }
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
            $trackingRequests = TrackingRequest::with('user')->where('is_active', 1)->where('is_deleted', 0)->orderByDesc('id')->paginate(10);
        } else {
            $trackingRequests = TrackingRequest::with('user')->where('user_id', $user->id)->where('is_active', 1)->where('is_deleted', 0)->orderByDesc('id')->paginate(10);
        }
        return view('dashboard.pages.tracking_history', compact('trackingRequests'))->with('title', 'Tracking History');
    }
}
