@extends('auth.layouts.main')
@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('dashboard') }}"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"><b>Admin</b>LTE</h1>
                </a>
            </div>

            <div class="card-body">
                <p class="login-box-msg">Enter your new password.</p>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ $email ?? old('email') }}" required autocomplete="email">

                            <label for="email">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="password" type="password" name="password" class="form-control @error('email') is-invalid @enderror"
                                placeholder="New Password" required />
                            <label for="password">New Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock"></span></div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" placeholder="Confirm Password" required />
                            <label for="password_confirmation">Confirm Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock"></span></div>
                    </div>

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{ route('login') }}">Back to Login</a>
                </p>
            </div>
        @endsection
