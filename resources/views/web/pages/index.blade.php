@extends('web.layouts.main')
@section('content')
    <!-- Banner Section -->
    <section class="banner text-center d-flex align-items-center justify-content-center text-white">

        <div class="main-banner-content">
            <div class="container">
                <h2 class="main-heading"><span class="gradient-text">Track</span> Any Phone<br>with Consent in Seconds</h2>
                <p class="banner-p mt-3">Instant, secure, and legal phone tracking. Just enter a phone number, send a
                    request, and get the location—only with recipient's consent.</p>
                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn btn-bg mt-4 px-5 py-2">Start Tracking Now →</a>
            </div>
        </div>
    </section>

    <!-- Locate Phone Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="heading-two">Locate a Phone in Just a Few Steps</h3>
                    <div class="mb-4">
                        <h5>Instruction</h5>
                        <ul>
                            <li>Enter the phone number you want to locate</li>
                            <li>Choose how to send the request (SMS, WhatsApp, or Email)</li>
                            <li>See their location in seconds</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 right-form-card">

                    <div class="card p-4">
                        <form class="home-form">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Method*</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sms" checked>
                                    <label class="form-check-label" for="sms">SMS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="whatsapp">
                                    <label class="form-check-label" for="whatsapp">WhatsApp</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="email">
                                    <label class="form-check-label" for="email">Email</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Contact Number*</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <img src="https://flagcdn.com/us.svg" width="20" alt="USA">
                                    </span>
                                    <input type="text" class="form-control" placeholder="446 552 3323">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Message Box</label>
                                <textarea class="form-control" rows="3" placeholder="Type Here"></textarea>
                            </div>

                            <button type="submit" class="btn btn-bg w-100">Start Tracking Now →</button>
                        </form>
                    </div>

                </div>
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
                <a href="#" class="btn btn-bg">Locate Now</a>
            </div>
        </section>
    </div>




    <!-- How It Works Section -->
    <section class="how-it-works">
        <h2 class="heading-two">How It Works: Quick & Simple</h2>
        <div class="steps">
            <div class="step">
                <img src="{{ asset('web/images/icon-enter-phone.png') }}" alt="Step 1">
                <h3 class="heading-three">Enter The Phone Number</h3>
                <p>Choose SMS, WhatsApp, or Email. Your request will be sent instantly.</p>
            </div>
            <div class="step">
                <img src="{{ asset('web/images/icon-recipient.png') }}" alt="Step 2">
                <h3 class="heading-three">Recipient Grants Consent</h3>
                <p>Once the person approves, their live location is shared with you.</p>
            </div>
            <div class="step">
                <img src="{{ asset('web/images/icon-view.png') }}" alt="Step 3">
                <h3 class="heading-three">View Their Location</h3>
                <p>Location is displayed instantly on your dashboard with an email or SMS alert.</p>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us">
        <h2 class="heading-two">Why Choose Us?</h2>
        <div class="features">
            <div class="feature">
                <img src="{{ asset('web/images/icon-accurate-tracking.png') }}" alt="Accurate Tracking">
                <h4 class="heading-three">Accurate Tracking</h4>
                <p>Get precise GPS-based location tracking.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('web/images/icon-secure-private.png') }}" alt="Secure & Private">
                <h4 class="heading-three">Secure & Private</h4>
                <p>GDPR-compliant, no data sharing.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('web/images/icon-no-app.png') }}" alt="No App Installation">
                <h4 class="heading-three">No App Installation Needed</h4>
                <p>Works directly from any web browser.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('web/images/icon-instant-tracking.png') }}" alt="Instant Tracking">
                <h4 class="heading-three">Instant Tracking</h4>
                <p>Get results within seconds after recipient approval.</p>
            </div>
        </div>
    </section>

    <!-- Locate Now CTA -->
    <section class="cta-locate">
        <h2 class="heading-two">Find Any Phone Now with One Click!</h2>
        <a href="#" class="btn btn-bg">Locate Now →</a>
    </section>

    <!-- Trusted By Users Section -->
    <section class="trusted-users">
        <h2 class="heading-two">Trusted by Thousands of Users Worldwide</h2>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide review">
                    <p>"I found my lost phone instantly using LocationFinder. Super easy and secure!"</p>
                    <div class="reviewer">
                        <img src="user1.png" alt="John D.">
                        <span>John D.</span>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide review">
                    <p>"Amazing service! Found my kid's phone within minutes."</p>
                    <div class="reviewer">
                        <img src="user2.png" alt="Jane D.">
                        <span>Jane D.</span>
                    </div>
                </div>

                <!-- Add more slides as needed -->

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </section>


    <div class="container">
        <section class="start-tracking">
            <div class="start-tack-content">
                <h4 class="heading-two">Start <span class="success">Tracking </span> a Phone Now!</h4>
                <a href="#" class="btn btn-bg">Locate Now</a>
            </div>
        </section>
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
                        <p><a href="#">LocationTracker.site</a> allows you to locate a phone by accessing its GPS
                            coordinates remotely through a simple consent-based flow.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-card">
                        <div class="faq-card-header">
                            <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
                        </div>
                        <h6>How do I reset my password?</h6>
                        <p>To reset your password, click “Forgot Password” on the login page. You will receive an email with
                            a reset link.</p>
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
                        <p>We are 100% legally compliant with strict user consent policies, ensuring tracking only happens
                            with appropriate authorization.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-card">
                        <div class="faq-card-header">
                            <img src="{{ asset('web/images/faq-icon.png') }}" alt="">
                        </div>
                        <h6>How is my data protected?</h6>
                        <p>We use SSL encryption to protect your information. We also follow strict compliance for data
                            security and privacy regulations.</p>
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
        <section class="track-a-phone">
            <div class="track-phone-content">
                <h4 class="heading-two">Track a <span class="success">Phone </span> Now—It Only Takes Seconds!</h4>
                <a href="#" class="btn btn-bg">Locate Now</a>
            </div>
        </section>
    </div>
@endsection
