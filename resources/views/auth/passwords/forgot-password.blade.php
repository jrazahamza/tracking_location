@extends('auth.layouts.main')
@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header">
        <a
          href="{{ route('dashboard') }}"
          class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
        >
          <h1 class="mb-0"><b>Admin</b>LTE</h1>
        </a>
      </div>
      
      <div class="card-body login-card-body">
    <p class="login-box-msg">Forgot your password? Enter your email to reset it.</p>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control" placeholder="Email" required />
                <label for="email">Email</label>
            </div>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
            </div>
        </div>
    </form>

    <p class="mb-1">
        <a href="{{ route('login') }}">Back to Login</a>
    </p>
</div>

@endsection
