    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('admin/assets/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const visitors_chart_options = {
            series: [{
                    name: 'High - 2023',
                    data: [100, 120, 170, 167, 180, 177, 160],
                },
                {
                    name: 'Low - 2023',
                    data: [60, 80, 70, 67, 80, 77, 100],
                },
            ],
            chart: {
                height: 200,
                type: 'line',
                toolbar: {
                    show: false,
                },
            },
            colors: ['#0d6efd', '#adb5bd'],
            stroke: {
                curve: 'smooth',
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5,
                },
            },
            legend: {
                show: false,
            },
            markers: {
                size: 1,
            },
            xaxis: {
                categories: ['22th', '23th', '24th', '25th', '26th', '27th', '28th'],
            },
        };

        const visitors_chart = new ApexCharts(
            document.querySelector('#visitors-chart'),
            visitors_chart_options,
        );
        visitors_chart.render();

        const sales_chart_options = {
            series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                },
                {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                },
                {
                    name: 'Free Cash Flow',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                },
            ],
            chart: {
                type: 'bar',
                height: 200,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997', '#ffc107'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent'],
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return '$ ' + val + ' thousands';
                    },
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#sales-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script> --}}

    <script>
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
