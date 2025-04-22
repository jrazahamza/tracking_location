@extends('dashboard.layouts.main')
@section('content')
    <div class="container mt-5">
        <h1>Send Tracking Request</h1>

        {{-- @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif --}}
        @if (session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('tracking.send') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter email to track" required>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Send Request</button>

        </form>
        </div>
    @endsection
