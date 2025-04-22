@extends('dashboard.layouts.main')
@section('content')
    <div class="container mt-5">
        <h2>My Profile</h2>

        {{-- @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif --}}

        <form action="{{ route('update.password') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password"
                       class="form-control @error('current_password') is-invalid @enderror">
                @error('current_password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password"
                       class="form-control @error('new_password') is-invalid @enderror">
                @error('new_password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
@endsection
