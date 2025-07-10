@extends('web.layouts.main')
@section('content')
    <!-- Banner Section -->
    <section class="banner text-center d-flex align-items-center justify-content-center text-white">

        <div class="main-banner-content">
            <div class="container">
                <h2 class="main-heading"><span class="gradient-text">Track</span> Any Phone<br>with Consent in Seconds</h2>
                <p class="banner-p mt-3">Instant, secure, and legal phone tracking. Just enter a phone number, send a
                    request, and get the location—only with recipient's consent.</p>
                <a href="#locate-form" class="btn btn-bg mt-4 px-5 py-2">Start
                    Tracking Now →</a>
            </div>
        </div>
    </section>

    <!-- Locate Phone Section -->
    <section class="py-5" id="locate-form">
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
                        <form action="{{ route('tracking.send') }}" method="POST" class="tracking-home-form">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Method*</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="methods[]" value="sms"
                                        id="sms" checked>
                                    <label class="form-check-label" for="sms">SMS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="methods[]" value="whatsapp"
                                        id="whatsapp">
                                    <label class="form-check-label" for="whatsapp">WhatsApp</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="methods[]" value="email"
                                        id="email">
                                    <label class="form-check-label" for="email">Email</label>
                                </div>
                            </div>

                            {{-- Email Input Field (hidden by default) --}}
                            <div class="mb-3 d-none" id="email-field">
                                <label class="form-label fw-bold">Email*</label>
                                <input type="email" class="form-control" name="email" id="email-input"
                                    placeholder="example@email.com">
                            </div>

                            {{-- Contact Number Field (hidden by default) --}}
                            {{-- <div class="mb-3 d-none" id="contact-number-field">
                                <label class="form-label fw-bold">Contact Number*</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <img src="https://flagcdn.com/us.svg" width="20" alt="USA">
                                    </span>
                                    <input type="tel" id="contact_number" class="form-control" name="contact_number"
                                        placeholder="446 552 3323" required>
                                </div>
                            </div> --}}

                            {{-- Contact Number Field (hidden by default) --}}
                            <div class="mb-3 d-none" id="contact-number-field">
                                <label class="form-label fw-bold">Contact Number*</label>
                                <div class="input-group">
                                    <input type="tel" id="contact_number" class="form-control" name="contact_number"
                                        placeholder="300 1234567">
                                </div>
                            </div>


                            <div class="mb-3 message-box">
                                <label class="form-label fw-bold">Message Box</label>
                                <textarea class="form-control" name="message" rows="3" placeholder="Type Here"></textarea>

                                <div class="message-box-buttons">
                                    <button class="track-locaton"
                                        data-message="Your location is being tracked. Please stay online.">Track
                                        Location</button>
                                    <button class="track-locaton"
                                        data-message="Tracking has started now. We’ll notify you once the target is reached.">Start
                                        Tracking Now</button>
                                </div>
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
                <a href="#locate-form" class="btn btn-bg">Locate Now</a>
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
        <a href="#locate-form" class="btn btn-bg">Locate Now →</a>
    </section>

    <!-- Trusted By Users Section -->
    <section class="trusted-users">
        <div class="container">
            <h2 class="heading-two">Trusted by Thousands of Users Worldwide</h2>

            <!-- Swiper -->
            <div class="swiper-slider-sec">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper ">
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-mark">“</div>
                                <p class="testimonial-text">
                                    I found my lost phone instantly using <strong>LocationFinder</strong>. <br />
                                    Super easy and secure!
                                </p>
                                <div class="user-info">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John D."
                                        class="user-img" />
                                    <span class="user-name">John D.</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-mark">“</div>
                                <p class="testimonial-text">
                                    I found my lost phone instantly using <strong>LocationFinder</strong>. <br />
                                    Super easy and secure!
                                </p>
                                <div class="user-info">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John D."
                                        class="user-img" />
                                    <span class="user-name">John D.</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-mark">“</div>
                                <p class="testimonial-text">
                                    I found my lost phone instantly using <strong>LocationFinder</strong>. <br />
                                    Super easy and secure!
                                </p>
                                <div class="user-info">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John D."
                                        class="user-img" />
                                    <span class="user-name">John D.</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-mark">“</div>
                                <p class="testimonial-text">
                                    I found my lost phone instantly using <strong>LocationFinder</strong>. <br />
                                    Super easy and secure!
                                </p>
                                <div class="user-info">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John D."
                                        class="user-img" />
                                    <span class="user-name">John D.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>


    <div class="container">
        <section class="start-tracking">
            <div class="start-tack-content">
                <h4 class="heading-two">Start <span class="success">Tracking </span> a Phone Now!</h4>
                <a href="#locate-form" class="btn btn-bg">Locate Now</a>
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
                    <a href="{{ route('find.location') }}#payment-sec" class="btn btn-bg w-100 mb-4">Get Trial</a>
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
                <a href="#locate-form" class="btn btn-orange">Locate Now →</a>
            </div>
        </div>
    </div>


    <div class="container">
        <section class="track-a-phone">
            <div class="track-phone-content">
                <h4 class="heading-two">Track a <span class="success">Phone </span> Now—It Only Takes Seconds!</h4>
                <a href="#locate-form" class="btn btn-bg">Locate Now</a>
            </div>
        </section>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
    <style>
        .iti {
            width: 100%;
        }

        .iti__selected-flag {
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            padding: 6px 8px;
        }

        input#contact_number {
            padding-left: 70px !important;
        }

        .iti--separate-dial-code input#contact_number {
            padding-left: 90px !important;
        }

        .iti__country-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .iti input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
    </style>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 3,
                spaceBetween: 10,
                cssMode: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    425: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    }
                },
                mousewheel: true,
                keyboard: true,
            });


            const smsCheckbox = document.getElementById('sms');
            const whatsappCheckbox = document.getElementById('whatsapp');
            const emailCheckbox = document.getElementById('email');

            const emailField = document.getElementById('email-field');
            const emailInput = document.getElementById('email-input');

            const contactNumberField = document.getElementById('contact-number-field');
            const contactNumberInput = document.querySelector('input[name="contact_number"]');

            const form = document.querySelector('.tracking-home-form');


            function toggleFields() {
                if (smsCheckbox.checked || whatsappCheckbox.checked) {
                    contactNumberField.classList.remove('d-none');
                    contactNumberInput.setAttribute('required', 'required');
                } else {
                    contactNumberField.classList.add('d-none');
                    contactNumberInput.removeAttribute('required');
                }

                if (emailCheckbox.checked) {
                    emailField.classList.remove('d-none');
                    emailInput.setAttribute('required', 'required');
                } else {
                    emailField.classList.add('d-none');
                    emailInput.removeAttribute('required');
                }
            }

            smsCheckbox.addEventListener('change', toggleFields);
            whatsappCheckbox.addEventListener('change', toggleFields);
            emailCheckbox.addEventListener('change', toggleFields);

            toggleFields();

            // form.addEventListener('submit', function(e) {
            //     const isAnyChecked = smsCheckbox.checked || whatsappCheckbox.checked || emailCheckbox
            //         .checked;

            //     if (!isAnyChecked) {
            //         e.preventDefault();
            //         alert('Please select at least one method (SMS, WhatsApp, or Email).');
            //     }
            // });

            const messageBox = document.querySelector('textarea[name="message"]');
            const buttons = document.querySelectorAll('.track-locaton');

            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const message = this.getAttribute('data-message');
                    messageBox.value = message;
                });
            });

            // ---- intl-tel-input setup ---- //
            const iti = window.intlTelInput(contactNumberInput, {
                initialCountry: "us",
                separateDialCode: true,
                dropdownContainer: document.body,

                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            // ---- Form submit: override number ---- //
            form.addEventListener('submit', function(e) {
                const isAnyChecked = smsCheckbox.checked || whatsappCheckbox.checked || emailCheckbox
                    .checked;

                if (!isAnyChecked) {
                    e.preventDefault();
                    alert('Please select at least one method (SMS, WhatsApp, or Email).');
                    return;
                }

                // Set full number with country code
                if (contactNumberInput.value.trim() !== "") {
                    contactNumberInput.value = iti.getNumber();
                }
            });
        });
    </script>
@endsection
