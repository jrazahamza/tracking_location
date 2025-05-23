@extends('web.layouts.main')
@section('content')

<!-- Banner Section -->

<section class="checkout-banner text-center d-flex align-items-center justify-content-center text-white">

    <div class="main-banner-content">
        <div class="container">
            <img src="{{ asset('web/images/error-icon.png') }}" alt="">
            <h2 class="main-heading">Payment Failed – Please Try Again</h2>
        </div>
  </div>
</section>


<div class="container py-5 text-center">
    {{-- <div class="check-icon">
      <i class="bi bi-check-lg"></i>
      <img src="{{ asset('web/images/success-icon.png') }}" alt="">
    </div> --}}

    <h2 class="heading">We couldn’t complete your payment.</h2>
    <p class="text-muted small mx-auto" style="width: 70%;">
      Unfortunately, your payment didn’t go through. This may be due to one of the following reasons:
    </p>

    <div class="next-steps mt-5">
      {{-- <h5 class="fw-bold mb-4">What’s next?</h5> --}}
      <div class="row g-4 justify-content-center">
        <div class="col-md-3">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/error-icon.png') }}" alt="">
            </div>
            <p class="mb-0">Incorrect card number, expiration date, or CVV</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/error-icon.png') }}" alt="">
            </div>
            <p class="mb-0">Insufficient funds or card restrictions</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/error-icon.png') }}" alt="">
            </div>
            <p class="mb-0">Network or processing error</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/error-icon.png') }}" alt="">
            </div>
            <p class="mb-0">Payment declined by your bank</p>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <p class="text-muted mt-2">Please review your details and try again. If the issue persists, consider using a different card or contacting your bank for more information.</p>
        <a href="{{ route('find.location') }}" class="btn btn-orange"> Try Again →</a>
        <p class="text-muted mt-2">Return to checkout and review your payment details.</p>
      </div>
    </div>
  </div>

@endsection


@section('css')
<style>

.nav-ul-cus .nav-item a {
    color: #000 !important;
}
nav.custom-nav-cls {
    border-bottom: 1px solid #373737;
}
@media screen and (max-width: 768px) {
    .cus-nav-links {
        position: absolute;
        right: 0px;
        top: 86%;
        width: 100%;
        background-color: #f4f9ff;
        padding-bottom: 20px;
    }

    .custom-nav-cls .navbar-toggler {
    background-color: #ff9800 !important;
    }

}
</style>

@endsection
