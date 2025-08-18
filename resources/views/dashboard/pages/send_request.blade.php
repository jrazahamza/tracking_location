@extends('dashboard.layouts.main')
@section('content')
    <div class="container mt-5">
        <h1>Send Tracking Request</h1>

        {{-- @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif --}}
        @if (session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('tracking.send') }}" id="tracking-form">
            @csrf

            {{-- Method Selection --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Method*</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="methods[]" value="sms" id="sms" checked
                        {{ is_array(old('methods')) && in_array('sms', old('methods')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sms">SMS</label>
                </div>
                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="methods[]" value="whatsapp" id="whatsapp"
                        {{ is_array(old('methods')) && in_array('whatsapp', old('methods')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="whatsapp">WhatsApp</label>
                </div> --}}
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="methods[]" value="email" id="email"
                        {{ is_array(old('methods')) && in_array('email', old('methods')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="email">Email</label>
                </div>
                @error('methods')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email Field (shown if "email" is selected) --}}
            <div class="mb-3 d-none" id="email-field">
                <label class="form-label fw-bold">Email*</label>
                <input type="email" id="email-input" name="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter email to track"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Contact Number Field (shown if "sms" or "whatsapp" is selected) --}}
            {{-- <div class="mb-3 d-none" id="contact-number-field">
                <label class="form-label fw-bold">Contact Number*</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <img src="https://flagcdn.com/us.svg" width="20" alt="USA">
                    </span>
                    <input type="text" name="contact_number"
                        class="form-control @error('contact_number') is-invalid @enderror" placeholder="446 552 3323"
                        value="{{ old('contact_number') }}">
                </div>
                @error('contact_number')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="mb-3 d-none" id="contact-number-field">
                <label class="form-label fw-bold">Contact Number*</label>
                <input type="tel" id="contact_number" name="contact_number"
                    class="form-control @error('contact_number') is-invalid @enderror" placeholder="300 1234567"
                    value="{{ old('contact_number') }}">
                @error('contact_number')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Optional Message --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Message Box</label>
                <textarea class="form-control" name="message" rows="3" placeholder="Type Here">{{ old('message') }}</textarea>
                <div class="message-box-buttons">
                    <button class="track-locaton" data-message="Your location is being tracked. Please stay online.">Track
                        Location</button>
                    <button class="track-locaton"
                        data-message="Tracking has started now. We’ll notify you once the target is reached.">Start
                        Tracking Now</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Request</button>
        </form>

    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />

    <style>
        .message-box-buttons .track-locaton {
            border: unset;
            padding: 5px 18px;
            border-radius: 25px;
            text-transform: capitalize;
        }

        .message-box-buttons {
            margin-top: -39px;
            width: 100%;
            text-align: right;
            padding-right: 10px;
        }

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
            const smsCheckbox = document.getElementById('sms');
            // const whatsappCheckbox = document.getElementById('whatsapp');
            const emailCheckbox = document.getElementById('email');

            const emailField = document.getElementById('email-field');
            const emailInput = document.getElementById('email-input');

            const contactNumberField = document.getElementById('contact-number-field');
            const contactNumberInput = document.querySelector('input[name="contact_number"]');

            const form = document.getElementById('tracking-form');

            function toggleFields() {
                // Toggle the Contact Number field visibility based on SMS/WhatsApp selection
               // if (smsCheckbox.checked || whatsappCheckbox.checked) {
                if (smsCheckbox.checked) {
                    contactNumberField.classList.remove('d-none');
                    contactNumberInput.setAttribute('required', 'required');
                } else {
                    contactNumberField.classList.add('d-none');
                    contactNumberInput.removeAttribute('required');
                }

                // Toggle the Email field visibility based on Email checkbox selection
                if (emailCheckbox.checked) {
                    emailField.classList.remove('d-none');
                    emailInput.setAttribute('required', 'required');
                } else {
                    emailField.classList.add('d-none');
                    emailInput.removeAttribute('required');
                }
            }

            // Watch for changes on SMS, WhatsApp, and Email checkboxes
            smsCheckbox.addEventListener('change', toggleFields);
            // whatsappCheckbox.addEventListener('change', toggleFields);
            emailCheckbox.addEventListener('change', toggleFields);

            // On page load, ensure the correct fields are shown/hidden
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
                // const isAnyChecked = smsCheckbox.checked || whatsappCheckbox.checked || emailCheckbox.checked;
                const isAnyChecked = smsCheckbox.checked || emailCheckbox.checked;

                if (!isAnyChecked) {
                    e.preventDefault();
                    alert('Please select at least one method (SMS or Email).');
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
