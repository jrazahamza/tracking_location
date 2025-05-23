@extends('web.layouts.main')
@section('content')
    {{-- @dd($stripeKey) --}}
    <!-- Banner Section -->
    <section
        class="banner inner-banner contact-banner text-center d-flex align-items-center justify-content-center text-white">

        <div class="main-banner-content find-location-banner-content">
            <div class="container find-loca">
                <h2 class="main-heading">Find Location Now – Secure & Instant Access</h2>
                <p>Secure your account now for instant phone tracking. No waiting—just pay $0.95, and start locating right
                    away!</p>
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
                        <li><span><img src="{{ asset('web/images/ssl-pay-icon.png') }}" alt=""
                                    class="icon-ssl"></span>SSL Secure payment</li>
                        <li><span><img src="{{ asset('web/images/ssl-pay-icon.png') }}" alt=""
                                    class="icon-ssl"></span>100% satisfaction Guarantee</li>
                    </ul>
                    <div class="paycard-ssl-icons">
                        <div class="pay-card">
                            <div class="card-item"><img src="{{ asset('web/images/visa-card.png') }}" alt=""></div>
                            <div class="card-item"><img src="{{ asset('web/images/master-card.png') }}" alt="">
                            </div>
                        </div>
                        <div class="pay-card">
                            <div class="card-item"><img src="{{ asset('web/images/ssl-icon.png') }}" alt=""></div>
                            <div class="card-item"><img src="{{ asset('web/images/ssl-oky.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>

                <!-- Form for Payment -->
                <form id="payment-form">
                    @csrf
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Cardholder Name <span class="text-danger">*</span></label>
                        <input type="text" id="fullName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="card-number" class="form-label">Card Number <span class="text-danger">*</span></label>
                        <div id="card-number" class="form-control">
                            <!-- Stripe Card Number Element will be inserted here -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="expiry-date" class="form-label">Expiration Date <span
                                class="text-danger">*</span></label>
                        <div id="expiry-date" class="form-control">
                            <!-- Stripe Expiry Date Element will be inserted here -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cvc" class="form-label">CVC <span class="text-danger">*</span></label>
                        <div id="cvc" class="form-control">
                            <!-- Stripe CVC Element will be inserted here -->
                        </div>
                    </div>

                    <div id="card-errors" role="alert" style="color: red; margin-top: 5px;"></div>

                    <button type="submit" id="submit-btn" class="submit-btn btn btn-primary">Start Tracking Now</button>
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

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialize Stripe
        // const stripe = Stripe(
        //     'pk_test_51OyYVmDxo3C22BxLXaQMUe5zQ9fcUwTnhvYsLI2XIuUfBZKRlAa7oMCmchkddFKKWKthZqcfsgtgKLSMf8mt0RCW00vqPfFwnn'
        // );
        const stripe = Stripe('{{ $stripeKey }}');
        const elements = stripe.elements();

        // // Create and mount the card Element
        // const cardElement = elements.create('card');
        // cardElement.mount('#card-element');

        // // Handle real-time validation errors
        // cardElement.addEventListener('change', function(event) {
        //     const displayError = document.getElementById('card-errors');
        //     if (event.error) {
        //         displayError.textContent = event.error.message;
        //     } else {
        //         displayError.textContent = '';
        //     }
        // });

        // Style for the card input fields
        const cardNumber = elements.create('cardNumber', {
            style: {
                base: {
                    color: "#495057",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: "16px",
                    padding: "12px 15px",
                    border: "1px solid #ced4da",
                    borderRadius: "4px",
                    backgroundColor: "#fff",
                },
                invalid: {
                    color: "#dc3545",
                    iconColor: "#dc3545",
                }
            }
        });

        const expiryDate = elements.create('cardExpiry', {
            style: {
                base: {
                    color: "#495057",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: "16px",
                    padding: "12px 15px",
                    border: "1px solid #ced4da",
                    borderRadius: "4px",
                    backgroundColor: "#fff",
                },
                invalid: {
                    color: "#dc3545",
                    iconColor: "#dc3545",
                }
            }
        });

        const cvc = elements.create('cardCvc', {
            style: {
                base: {
                    color: "#495057",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: "16px",
                    padding: "12px 15px",
                    border: "1px solid #ced4da",
                    borderRadius: "4px",
                    backgroundColor: "#fff",
                },
                invalid: {
                    color: "#dc3545",
                    iconColor: "#dc3545",
                }
            }
        });

        // Mount Stripe Elements into individual fields
        cardNumber.mount('#card-number');
        expiryDate.mount('#expiry-date');
        cvc.mount('#cvc');

        // Handle real-time validation errors for individual fields
        cardNumber.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        expiryDate.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        cvc.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            document.getElementById('submit-btn').disabled = true;

            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;

            try {
                // Step 1: Create Payment Intent on the server
                const intentResponse = await fetch('/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: email,
                        name: fullName
                    })
                });

                const intentData = await intentResponse.json();

                if (intentData.error) {
                    const response = intentData.error;
                    console.log(response);
                    if (intentData.error === 'User not authenticated. Please log in.') {
                        toastr.error(response.error || 'User not authenticated. Please log in');
                        setTimeout(() => {
                            window.location.href = response.redirect || '/login';
                        }, 1500); // Wait 1.5 seconds before redirect
                        return;
                    }
                    toastr.error(intentData.error);
                    throw new Error(intentData.error);
                }

                // Step 2: Confirm the card payment with Stripe
                const {
                    error,
                    paymentIntent
                } = await stripe.confirmCardPayment(
                    intentData.clientSecret, {
                        payment_method: {
                            card: cardNumber,
                            billing_details: {
                                name: fullName,
                                email: email
                            }
                        }
                    }
                );

                if (error) {
                    toastr.error(error.message);
                    throw new Error(error.message);
                }

                if (paymentIntent.status === 'succeeded') {

                    // Payment succeeded - notify server and redirect
                    const result = await fetch('/payment-complete', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            payment_intent_id: paymentIntent.id
                        })
                    });

                    const response = await result.json();

                    if (response.success) {
                        toastr.success(response.message || 'Payment successful');
                        setTimeout(() => {
                            window.location.href = response.redirect || '/dashboard';
                        }, 1500); // Wait 1.5 seconds before redirect
                    } else {

                        toastr.error(response.message || 'Payment verification failed');
                        setTimeout(() => {
                            window.location.href = response.redirect || '/checkouterror';
                        }, 1500);
                        throw new Error(response.message || 'Payment verification failed');
                    }
                }
            } catch (error) {

                toastr.error(error.message);
                document.getElementById('card-errors').textContent = error.message;
                document.getElementById('submit-btn').disabled = false;
                setTimeout(() => {
                    window.location.href = error.redirect || '/checkouterror';
                }, 1500);
            }
        });
    </script>
@endsection
