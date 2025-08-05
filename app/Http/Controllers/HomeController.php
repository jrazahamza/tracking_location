<?php

namespace App\Http\Controllers;

use App\Models\contactUs;
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

    public function manage_users()
    {
        $user = Auth::user();
        if ($user->role_id != '1') {
            abort(403, 'Access Denied.');
        }
        $users = User::where('role_id', '!=', 1)->where('is_active', 1)->where('is_deleted', 0)->latest()->paginate(10);
        return view('dashboard.pages.manage-users', compact('users'))->with('title', 'Manage Users');
    }

    public function edit_user($id)
    {
        $user = User::where('is_active', 1)->where('is_deleted', 0)->findOrFail($id);
        return view('dashboard.pages.edit-user', compact('user'))->with('title', 'Edit User');
    }
    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            // 'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'street_address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'description' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile')) {
            if ($user->profile && file_exists(public_path($user->profile))) {
                unlink(public_path($user->profile));
            }

            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $user->profile = 'uploads/profile/' . $filename;
        }

        // Update user fields
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        // $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->gender = $request->gender;
        $user->street_address = $request->street_address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->description = $request->description;

        $user->save();

        return redirect()->route('manage-users')->with('message', 'User updated successfully!');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = 0;
        $user->is_deleted = 1;
        $user->save();

        return redirect()->route('manage-users')->with('success', 'User deleted successfully.');
    }

    public function contacts()
    {
        $user = Auth::user();
        if ($user->role_id != '1') {
            abort(403, 'Access Denied.');
        }
        $contacts = contactUs::where('is_active', 1)->where('is_deleted', 0)->latest()->paginate(10);
        return view('dashboard.pages.contacts', compact('contacts'))->with('title', 'All Contacts');
    }

    // contact_delete
    public function contact_delete($id)
    {
        $contact = contactUs::findOrFail($id);
        $contact->is_active = 0;
        $contact->is_deleted = 1;
        $contact->save();

        return back()->with('message', 'Contact deleted successfully!');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            // 'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            // 'email' => 'required|email|unique:users,email,' . $user->id,
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
