@extends('web.layouts.main')
@section('content')

<!-- Banner Section -->

<section class="checkout-banner text-center d-flex align-items-center justify-content-center text-white">
    
    <div class="main-banner-content">
        <div class="container">
            <img src="{{ asset('web/images/success-icon.png') }}" alt="">
            <h2 class="main-heading">Payment Successful – You’re All Set!</h2>
        </div>
  </div>
</section>


<div class="container py-5 text-center">
    {{-- <div class="check-icon">
      <i class="bi bi-check-lg"></i>
      <img src="{{ asset('web/images/success-icon.png') }}" alt="">
    </div> --}}

    <h2 class="heading">Thank you for your payment. Your account is now active.</h2>
    <p class="text-muted small mx-auto" style="width: 70%;">
      Your transaction was successful, and your account has been automatically created using the email address you provided.
      You can now start sending tracking requests and viewing results from your dashboard.
      You’ll receive a confirmation email shortly with your account details and a receipt for your payment.
    </p>

    <div class="next-steps mt-5">
      <h5 class="fw-bold mb-4">What’s next?</h5>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/success-icon.png') }}" alt="">
            </div>
            <p class="mb-0">You can send your first tracking request right away.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/success-icon.png') }}" alt="">
            </div>
            <p class="mb-0">All tracking requests and history will be saved in your account.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="step-box">
            <div class="check-icon">
              <img src="{{ asset('web/images/success-icon.png') }}" alt="">
            </div>
            <p class="mb-0">You’ll be notified by email and SMS whenever a location is confirmed.</p>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <a href="#" class="btn btn-orange">Go to Dashboard →</a>
        <p class="text-muted mt-2">Start your first tracking request now from your dashboard.</p>
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