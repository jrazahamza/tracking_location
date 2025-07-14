@extends('web.layouts.main')
@section('content')

<!-- Banner Section -->
<section class="banner inner-banner contact-banner text-center d-flex align-items-center justify-content-center text-white">

    <div class="main-banner-content">
  <div class="container">
        <h2 class="main-heading">Frequently Asked Question</h2>
    </div>
  </div>
</section>


<!-- Call-to-Action Section -->
<!-- <section class="cta-section text-center py-5">
  <div class="container">
    <h2 class="text-primary mb-3">Track a Phone Now—It Only Takes Seconds!</h2>
    <button class="btn btn-warning">Locate Now →</button>
  </div>
</section> -->

<div class="container">
    <section class="want-to-locate-banner">
        <div class="want-content">
            <h4 class="heading-two">Want to <span class="success">Locate</span> a Phone Instantly?</h4>
            <a href="{{ route('home') }}#locate-form" class="btn btn-bg">Locate Now</a>
        </div>
    </section>
</div>


<section class="tracing-sec">
    <div class="container">
        <div class="tracking-section">
            <h2 class="heading-two">Tracking</h2>

            <div class="tracking-box">
            <h5>How does phone tracking work?</h5>
            <p>
                LocationFinder.online allows you to send a location request to a phone number. The recipient must give explicit consent before their location is shared. Once they approve, their last known location is displayed on an interactive map in your account.
            </p>
            </div>

            <div class="tracking-box">
            <h5>Is tracking legal?</h5>
            <p>
                Yes, our service is fully compliant with GDPR and global privacy regulations. Location tracking is only available with the recipient's consent, ensuring full transparency and legality.
            </p>
            </div>
        </div>
    </div>
</section>


  <div class="container">
    <section class="start-tracking">
        <div class="start-tack-content">
            <h4 class="heading-two">Start <span class="success">Tracking </span> a Phone Now!</h4>
            <a href="{{ route('home') }}#locate-form" class="btn btn-bg">Locate Now</a>
        </div>
    </section>
  </div>


  <section class="tracing-sec">
    <div class="container">
        <div class="tracking-section">
            <h2 class="heading-two">Payment</h2>

            <div class="tracking-box">
            <h5>How much does it cost?</h5>
            <p>
                You can start tracking for only $0.95 for the first 24 hours. After the trial, it continues as a monthly subscription that provides unlimited tracking requests.
            </p>
            </div>

            <div class="tracking-box">
            <h5>Can I cancel my subscription?</h5>
            <p>
                Yes, you can cancel anytime in your account settings. There are no hidden fees, and you will not be charged after cancellation.
            </p>
            </div>
        </div>
    </div>
</section>


  <section class="tracing-sec">
    <div class="container">
        <div class="tracking-section">
            <h2 class="heading-two">Account Management</h2>

            <div class="tracking-box">
            <h5>How do I reset my password?</h5>
            <p>
                To reset your password, click “Forgot Password” on the login page. You will receive an email with a reset link to update your password.
            </p>
            </div>

            <div class="tracking-box">
            <h5>How do I update my email?</h5>
            <p>
                Go to Account Settings in your dashboard and select "Update Email" to change your email address.
            </p>
            </div>
        </div>
    </div>
</section>

  <section class="tracing-sec">
    <div class="container">
        <div class="tracking-section">
            <h2 class="heading-two">Legal & Privacy</h2>

            <div class="tracking-box">
            <h5>How is my data protected?</h5>
            <p>
                We use SSL encryption to protect your data. Your personal information is never shared with third parties, and location data is only stored temporarily for tracking purposes.
            </p>
            </div>

            <div class="tracking-box">
            <h5>Can I request data deletion?</h5>
            <p>
                Yes. You can request full data deletion by contacting our support team. We comply with GDPR and privacy regulations to ensure your data is securely removed.
            </p>
            </div>
        </div>
    </div>
</section>


<div class="container">
    <section class="track-a-phone">
        <div class="track-phone-content">
            <h4 class="heading-two">Track a  <span class="success">Phone </span> Now—It Only Takes Seconds!</h4>
            <a href="{{ route('home') }}#locate-form" class="btn btn-bg">Locate Now</a>
        </div>
    </section>
  </div>


  @endsection
