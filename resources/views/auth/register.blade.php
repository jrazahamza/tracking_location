@extends('auth.layouts.main')
@section('content')
    <div class="register-box">
        <!-- /.register-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{ route('dashboard') }}"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    {{-- <h1 class="mb-0"><b>Admin</b>LTE</h1> --}}
                    <img src="http://127.0.0.1:8000/web/images/logo-location-finder.png" alt="" class="footer-logo">

                </a>
            </div>
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    {{-- First Name --}}
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerFullName" type="text" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}" placeholder="" />
                            <label for="registerFullName">First Name</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                    </div>
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Last Name --}}
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerLastName" type="text" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}"
                                placeholder="" />
                            <label for="registerLastName">Last Name</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                    </div>
                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Email --}}
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerEmail" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="" />
                            <label for="registerEmail">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Password --}}
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerPassword" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="" />
                            <label for="registerPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Password Confirmation --}}
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="registerConfirmPassword" type="password" name="password_confirmation"
                                class="form-control" placeholder="" />
                            <label for="registerConfirmPassword">Confirm Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>

                    {{-- Terms --}}
                    <div class="form-check mb-2">
                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms"
                            id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault">
                            I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                    @error('terms')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Submit Button --}}
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>


                <p class="mb-0">
                    <a href="{{ route('login.form') }}" class="link-primary text-center">I already have a membership</a>
                </p>
            </div>

            <!-- /.register-card-body -->
        </div>
    </div>
@endsection
@section('css')
    <style>
        .is-invalid {
            border: 1px solid red;
        }

        .text-danger {
            color: red;
            font-size: 0.875rem;
        }
    </style>
@endsection
