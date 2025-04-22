@extends('dashboard.layouts.main')
@section('content')
    <div class="container mt-5">
        <h2>My Profile</h2>

        {{-- @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif --}}

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Profile Picture --}}
            <div class="mb-3">
                <label>Profile Picture</label><br>
                @if ($user->profile)
                    {{-- <img src="{{ asset($user->profile) }}" alt="Profile" width="100" class="mb-2"> --}}
                    <div class="mb-3">
                        <img src="{{ asset($user->profile) }}" alt="Profile Picture" class="rounded-circle border shadow-sm"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="profile" class="form-control @error('profile') is-invalid @enderror">
                @error('profile')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- First Name --}}
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                    class="form-control">
            </div>

            {{-- Last Name --}}
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                    class="form-control">
            </div>

            {{-- Username --}}
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control">
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
            </div>

            {{-- Phone No --}}
            <div class="mb-3">
                <label>Phone No</label>
                <input type="text" name="phone_no" value="{{ old('phone_no', $user->phone_no) }}" class="form-control">
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- Street Address --}}
            <div class="mb-3">
                <label>Street Address</label>
                <input type="text" name="street_address" value="{{ old('street_address', $user->street_address) }}"
                    class="form-control">
            </div>

            {{-- City --}}
            <div class="mb-3">
                <label>City</label>
                <input type="text" name="city" value="{{ old('city', $user->city) }}" class="form-control">
            </div>

            {{-- State --}}
            <div class="mb-3">
                <label>State</label>
                <input type="text" name="state" value="{{ old('state', $user->state) }}" class="form-control">
            </div>

            {{-- Country --}}
            <div class="mb-3">
                <label>Country</label>
                <input type="text" name="country" value="{{ old('country', $user->country) }}" class="form-control">
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $user->description) }}</textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
