@extends('web.layouts.main')
@section('content')

<!-- Banner Section -->
<section class="banner contact-banner text-center d-flex align-items-center justify-content-center text-white">

    <div class="main-banner-content">
  <div class="container find-loca">
        <h2 class="main-heading">Find Location Now – Secure & Instant Access</h2>
        <p>Secure your account now for instant phone tracking. No waiting—just pay $0.95, and start locating right away!</p>
    </div>
  </div>
</section>

  <section class="cta-locate">
    <h2 class="heading-two">Find Any Phone Now with One Click!</h2>
    <h4 class="get-start">$0.95 – Get Started Now</h4>
  </section>

<section class="contact-us-form">

<div class="contact-section">
    <!-- Left Side -->
    <div class="find-loc-left-img">
        <img src="{{ asset('web/images/find-loca-img.png') }}" alt="">
    </div>

    <!-- Right Side -->
    <div class="contact-right">
        <div class="header-conten">
            <h1>Payment</h1>
            <ul class="security">
                <li>SSL Secure payment</li>
                <li>100% satisfaction Guarantee</li>
            </ul>
            <div class="pay-card">
                <div class="card-item"><img src="{{ asset('web/images/visa-card.png') }}" alt=""></div>
                <div class="card-item"><img src="{{ asset('web/images/master-card.png') }}" alt=""></div>
            </div>
        </div>

      <form>
        <div class="mb-3">
          <label for="fullName" class="form-label">Card holder Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="fullName" placeholder="John Doe">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Card Number <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="email" placeholder="John Doe">
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="subject" class="form-label">Expiry Date <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="subject" placeholder="John Doe">
                </div>
                <div class="col-md-6">
                    <label for="subject" class="form-label">CVV <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="subject" placeholder="John Doe">
               </div>
           </div>
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Email Address <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="subject" placeholder="John Doe">
        </div>
        <button type="submit" class="submit-btn">Start Tracking Now</button>
      </form>
    </div>
  </div>

</section>



<!-- FAQ Section -->
<div class="container py-5">
  <div class="faq-section">
    <h2 class="text-center heading-two mb-5">Have Questions? We’ve Got Answers!</h2>
    <div class="row g-4">
      <div class="col-md-4">
          <div class="faq-card">
            <div class="faq-card-header">
                <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
            </div>
          <h6>How does phone tracking work?</h6>
          <p><a href="#">LocationTracker.site</a> allows you to locate a phone by accessing its GPS coordinates remotely through a simple consent-based flow.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="faq-card">
            <div class="faq-card-header">
                <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
            </div>
          <h6>How do I reset my password?</h6>
          <p>To reset your password, click “Forgot Password” on the login page. You will receive an email with a reset link.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="faq-card">
            <div class="faq-card-header">
                <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
            </div>
          <h6>Can I track the same number more than once?</h6>
          <p>Yes, you can, and multiple tracking sessions are stored securely in your account’s history.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="faq-card">
            <div class="faq-card-header">
                <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
            </div>
          <h6>Is tracking legal?</h6>
          <p>We are 100% legally compliant with strict user consent policies, ensuring tracking only happens with appropriate authorization.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="faq-card">
            <div class="faq-card-header">
                <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
            </div>
          <h6>How is my data protected?</h6>
          <p>We use SSL encryption to protect your information. We also follow strict compliance for data security and privacy regulations.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="faq-card">
            <div class="faq-card-header">
                <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
            </div>
          <h6>Is the recipient notified when I send a tracking request?</h6>
          <p>Yes, the recipient receives a notification, and tracking only proceeds after their consent.</p>
        </div>
      </div>
    </div>
    <div class="locate-btn">
        <button class="btn btn-orange">Locate Now →</button>
    </div>
  </div>
</div>



<!-- Simple & Affordable -->
<div class="container py-5">
    <div class="simple-affordable row align-items-center">
      <div class="col-md-8">
          <div class="afford-content">
              <h2 class="heading-two">Simple & Affordable Tracking Solution</h2>
              <p class="mt-3">Instant tracking. No hidden fees. Cancel anytime</p>
          </div>
      </div>
      <div class="col-md-4 get-tril-card">
        <div class="card-pricing text-center">
          <h2 class="text-primary mb-2">$0.95</h2>
          <p>Track any phone for just $0.95 for the first 24 hours.</p>
          <button class="btn btn-bg w-100 mb-4">Get Trial</button>
          <div class="text-start">
            <p><i class="bi bi-check-circle-fill icon-check"></i>Unlimited tracking</p>
            <p><i class="bi bi-check-circle-fill icon-check"></i>No per-user charges</p>
            <p><i class="bi bi-check-circle-fill icon-check"></i>No hidden fees</p>
            <p><i class="bi bi-check-circle-fill icon-check"></i>Just one simple plan</p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
