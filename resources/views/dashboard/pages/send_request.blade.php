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

        <form method="POST" action="{{ route('tracking.send') }}">
            @csrf

            {{-- Method Selection --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Method*</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="methods[]" value="sms" id="sms" checked
                        {{ is_array(old('methods')) && in_array('sms', old('methods')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sms">SMS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="methods[]" value="whatsapp" id="whatsapp"
                        {{ is_array(old('methods')) && in_array('whatsapp', old('methods')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="whatsapp">WhatsApp</label>
                </div>
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
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter email to track" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Contact Number Field (shown if "sms" or "whatsapp" is selected) --}}
            <div class="mb-3 d-none" id="contact-number-field">
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
            </div>

            {{-- Optional Message --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Message Box</label>
                <textarea class="form-control" name="message" rows="3" placeholder="Type Here">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Request</button>
        </form>

    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const smsCheckbox = document.getElementById('sms');
            const whatsappCheckbox = document.getElementById('whatsapp');
            const emailCheckbox = document.getElementById('email');

            const emailField = document.getElementById('email-field');
            const emailInput = document.getElementById('email-input');

            const contactNumberField = document.getElementById('contact-number-field');
            const contactNumberInput = document.querySelector('input[name="contact_number"]');

            function toggleFields() {
                // Toggle the Contact Number field visibility based on SMS/WhatsApp selection
                if (smsCheckbox.checked || whatsappCheckbox.checked) {
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
            whatsappCheckbox.addEventListener('change', toggleFields);
            emailCheckbox.addEventListener('change', toggleFields);

            // On page load, ensure the correct fields are shown/hidden
            toggleFields();
        });
    </script>
@endsection
