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
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                {{-- @if (Session::has('error'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('error') }}
                    </div>
                @endif --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="" />
                            <label for="loginEmail">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" />
                            <label for="loginPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="row mt-2">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>




                <!-- /.social-auth-links -->
                <p class="mb-1"><a href="{{ route('password.request') }}">I forgot my password</a></p>
                <p class="mb-0">
                    <a href="{{ route('register.form') }}" class="text-center"> Register a new membership </a>
                </p>
            </div>
            <!-- /.login-card-body -->
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
