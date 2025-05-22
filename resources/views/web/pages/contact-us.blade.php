@extends('web.layouts.main')
@section('content')

<!-- Banner Section -->
<section class="banner inner-banner contact-banner text-center d-flex align-items-center justify-content-center text-white">

    <div class="main-banner-content">
  <div class="container">
        <h2 class="main-heading">Contact Us</h2>
    </div>
  </div>
</section>


<div class="container">
    <section class="want-to-locate-banner">
        <div class="want-content">
            <h4 class="heading-two">Want to <span class="success">Locate</span> a Phone Instantly?</h4>
            <a href="#" class="btn btn-bg">Locate Now</a>
        </div>
    </section>
</div>

<section class="contact-us-form">

<div class="contact-section">
    <!-- Left Side -->
    <div class="contact-left">
      <h2>Contact Form</h2>
      <p><strong>Direct Email Support</strong></p>
      <div class="email-box">
        <div class="email-icon text-white">
          <i class="bi bi-envelope-fill"></i>
        </div>
        <div>
          <p class="mb-0">Email</p>
          <p class="mb-0">support@locationfinder.online</p>
        </div>
      </div>
      <p class="response-time">Average response time: 24 hours</p>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Right Side -->
    <div class="contact-right">
      <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="John Doe">
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="subject" id="subject" placeholder="John Doe">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
          <textarea class="form-control" id="message" name="message" rows="4" placeholder="John Doe"></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit Form →</button>
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



<div class="container">
    <section class="start-tracking">
        <div class="start-tack-content">
            <h4 class="heading-two">Start <span class="success">Tracking </span> a Phone Now!</h4>
            <a href="#" class="btn btn-bg">Locate Now</a>
        </div>
    </section>
</div>

@endsection
