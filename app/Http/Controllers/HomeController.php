<?php

namespace App\Http\Controllers;

use App\Models\TrackingRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $query = TrackingRequest::with('user')
            ->where('is_active', 1)
            ->where('is_deleted', 0);

        if ($user->role_id != '1') {
            $query->where('user_id', $user->id);
        }

        $allTrackingRequests = $query->get();

        $totalTrackingRequests = $allTrackingRequests->count();
        $pendingRequests = $allTrackingRequests->where('status', 'pending')->count();
        $activeRequests = $allTrackingRequests->where('status', 'active')->count();
        $cancelledRequests = $allTrackingRequests->where('status', 'cancelled')->count();

        $trackingRequests = $query->orderByDesc('id')->paginate(10);

        return view('dashboard.pages.dashboard', compact('trackingRequests', 'totalTrackingRequests', 'pendingRequests', 'activeRequests', 'cancelledRequests'))->with('title', 'Dashboard');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.pages.user-profile', compact('user'))->with('title', 'Profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'street_address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'description' => 'nullable|string',
            'profile' => 'nullable|image|max:2048',
            'newsletter' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'is_deleted' => 'nullable|boolean',
        ]);


        if ($request->file('profile')) {
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName(); // Optional: add user ID for uniqueness
            $file->move(public_path('uploads/profile'), $filename);
            $validated['profile'] = 'uploads/profile/' . $filename;
        }

        $user->update($validated);

        return back()->with('message', 'Profile updated successfully!');
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('dashboard.pages.update-password', compact('user'))->with('title', 'Change Password');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Password updated successfully!');
    }
}
