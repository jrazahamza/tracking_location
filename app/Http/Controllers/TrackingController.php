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
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

    // public function sendTrackingRequest(Request $request)
    // {
    //     $rules = [
    //         'methods' => 'required|array|min:1',
    //         'message' => 'nullable|string',
    //     ];

    //     if (in_array('sms', $request->methods) || in_array('whatsapp', $request->methods)) {
    //         $rules['contact_number'] = 'required|string';
    //     }

    //     if (in_array('email', $request->methods)) {
    //         $rules['email'] = 'required|email|string';
    //     }

    //     $request->validate($rules);

    //     try {
    //         $user = Auth::user();
    //         $token = Str::random(60);
    //         $methods = $request->methods;
    //         // dd($methods);
    //         $contactNumber = $request->contact_number;
    //         $email = $request->email;
    //         $message = $request->message ?? 'You are being tracked. Click to approve location sharing.';

    //         $trackingRequest = TrackingRequest::create([
    //             'user_id' => $user->id,
    //             'target_user_email' => $email ?? null,
    //             'token' => $token,
    //             'status' => 'pending',
    //             'target_contact_number' => $contactNumber ?? null,
    //             'message' => $message,
    //             'methods' => json_encode($methods),
    //         ]);

    //         $trackingLink = route('approve.tracking.request', $token);
    //         $fullMessage = $message . "\n\n Click the link to approve:\n" . $trackingLink;

    //         $twilio = new TwilioService();
    //         foreach ($methods as $method) {
    //             if ($method === 'sms') {

    //                 $twilio->sendSMS($contactNumber, $fullMessage);
    //                 logger("Sending SMS to {$contactNumber}: {$fullMessage}");
    //             }

    //             if ($method === 'whatsapp') {
    //                 $twilio->sendWhatsApp($contactNumber, $fullMessage);
    //                 logger("Sending WhatsApp to {$contactNumber}: {$fullMessage}");
    //             }

    //             if ($method === 'email') {
    //                 if (!$email) {
    //                     return back()->withErrors(['email' => 'Email is required if Email method is selected.']);
    //                 }
    //                 $trackingRequest->update(['target_user_email' => $email]);
    //                 Mail::to($email)->send(new TrackingRequestEmail($token, $message));
    //             }
    //         }

    //         return back()->with('message', 'Tracking request sent successfully via selected method(s).');
    //     } catch (\Exception $e) {
    //         Log::error('Error while sending tracking request: ' . $e->getMessage());
    //         Log::error('Stack trace: ' . $e->getTraceAsString());

    //         return back()->withInput()->with('error', $e->getMessage());
    //     }
    // }



    public function sendTrackingRequest(Request $request)
    {
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

        $errors = [];

        try {
            $user = Auth::user();
            $token = Str::random(60);
            $methods = $request->methods;
            $contactNumber = $request->contact_number;
            $email = $request->email;
            $message = $request->message ?? 'You are being tracked. Click to approve location sharing.';

            $trackingRequest = TrackingRequest::create([
                'user_id' => $user->id,
                'target_user_email' => $email ?? null,
                'token' => $token,
                'status' => 'pending',
                'target_contact_number' => $contactNumber ?? null,
                'message' => $message,
                'methods' => json_encode($methods),
            ]);

            $trackingLink = route('approve.tracking.request', $token);
            $fullMessage = $message . "\n\nClick the link to approve:\n" . $trackingLink;

            $twilio = new TwilioService();

            foreach ($methods as $method) {
                if ($method === 'sms') {
                    try {
                        $twilio->sendSMS($contactNumber, $fullMessage);
                        logger("SMS sent to {$contactNumber}");
                    } catch (\Exception $e) {
                        logger()->error("SMS Error: " . $e->getMessage());
                        $errors['sms'] = 'SMS failed: ' . $e->getMessage();
                    }
                }

                if ($method === 'whatsapp') {
                    try {
                        $twilio->sendWhatsApp($contactNumber, $fullMessage);
                        logger("WhatsApp sent to {$contactNumber}");
                    } catch (\Exception $e) {
                        logger()->error("WhatsApp Error: " . $e->getMessage());
                        $errors['whatsapp'] = 'WhatsApp failed: ' . $e->getMessage();
                    }
                }

                if ($method === 'email') {
                    try {
                        if (!$email) {
                            throw new \Exception('Email is required for email method.');
                        }
                        $trackingRequest->update(['target_user_email' => $email]);
                        Mail::to($email)->send(new TrackingRequestEmail($token, $message));
                        logger("Email sent to {$email}");
                    } catch (\Exception $e) {
                        logger()->error("Email Error: " . $e->getMessage());
                        $errors['email'] = 'Email failed: ' . $e->getMessage();
                    }
                }
            }

            if (!empty($errors)) {
                return back()->withErrors($errors)->withInput();
            }

            return back()->with('message', 'Tracking request sent successfully via selected method(s).');
        } catch (\Exception $e) {
            logger()->error("Main Error: " . $e->getMessage());
            return back()->withErrors(['general' => 'Something went wrong: ' . $e->getMessage()])->withInput();
        }
    }




    public function approveTrackingRequest($token)
    {
        $trackingRequest = TrackingRequest::where('token', $token)->firstOrFail();
        return view('dashboard.pages.get_location', compact('trackingRequest'))->with('title', 'Get Location');
    }

    public function saveLocation(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'token' => 'required',
                'latitude' => 'required_if:denied,false|nullable|numeric',
                'longitude' => 'required_if:denied,false|nullable|numeric',
                'denied' => 'nullable|boolean',
            ]);

            // Check if tracking token exists
            $trackingRequest = TrackingRequest::where('token', $request->token)->first();

            if (!$trackingRequest) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid tracking token.',
                ], 404);
            }

            // If user denied location access
            if ($request->denied == true) {
                $trackingRequest->update([
                    'status' => 'cancelled',
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Location access denied. Tracking cancelled.',
                ]);
            }

            // Update location based on status
            if (in_array($trackingRequest->status, ['pending', 'cancelled'])) {
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

            return response()->json([
                'status' => true,
                'message' => 'Location saved successfully.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            // Log error for debugging (optional)
            Log::error('Tracking error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(), // Optional: Remove in production
            ], 500);
        }
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
