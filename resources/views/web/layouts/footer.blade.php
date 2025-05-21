<!-- Footer -->
<footer class="bg-black text-white pt-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-4 about-sec">
          <img src="{{ asset('web/images/logo-location-finder.png') }}" alt="" class="footer-logo">
          <p>Kingsworth Services LLC<br>1309 Coffeen Avenue STE 1200<br>Sheridan Wyoming 82801</p>
        </div>
        <div class="col-sm-6 col-md-8 links-list">
          <ul class="list-unstyled">
            <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
            <li><a href="{{ route('contact-us') }}" class="text-white text-decoration-none">About</a></li>
            <li><a href="{{ route('faqs') }}" class="text-white text-decoration-none">Faqs</a></li>
            <li><a href="{{ route('find.location') }}" class="text-white text-decoration-none">Track Now</a></li>
          </ul>
        </div>
      </div>
      <div class="copy-right small py-3">
        <p class="mb-0">&copy; 2022 Location Finder Inc. All rights reserved</p>
        <p class="terms-privacy-links"><a href="#" class="text-white text-decoration-none">Terms and Conditions</a> • <a href="#" class="text-white text-decoration-none">Privacy Policy</a></p>
      </div>
    </div>
  </footer>
