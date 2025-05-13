<!-- SwiperJS Script -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
    const swiper = new Swiper('.mySwiper', {
        loop: true,
        autoplay: {
            delay: 3000
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    });

    @if ($errors->any())

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
        };

        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
        }
        toastr.success("{{ session('message') }}");
    @endif


    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "debug": false,
            "positionClass": "toast-top-right",
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "debug": false,
            "positionClass": "toast-top-right",
        }
        toastr.warning("{{ session('warning') }}");
    @endif
    $('.toast').on('click', function(event) {
        event.stopPropagation(); // Prevent the toast from closing when clicked
        // Optionally, add custom actions on click here
    });
</script>
