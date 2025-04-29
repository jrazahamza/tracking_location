@extends('dashboard.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tracking History</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalTrackingRequests }}</h3>

                                <p>Total Tracking Requests</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $activeRequests }}</h3>

                                <p>Active Tracking Requests</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    {{-- <div class="col-lg-2 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $totalUsers }}</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $pendingRequests }}</h3>

                                <p>Pending Tracking Request</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $cancelledRequests }}</h3>

                                <p>Cencel Tracking Request</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title fw-bold">
                                    Tracking Record
                                </h2>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ms-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="{{ route('tracking.history') }}">Records</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body p-0">
                                <div class="table-responsive"
                                    style="max-height: 550px; min-height: 420px; overflow-y: auto;">
                                    <table class="table table-striped mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Requester Name</th>
                                                <th>Target Email</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($trackingRequests->count() > 0)
                                                @foreach ($trackingRequests as $key => $value)
                                                    <tr class="align-middle">
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $value->user ? $value->user->full_name : '' }}</td>
                                                        <td>{{ $value->target_user_email }}</td>
                                                        <td>{{ $value->latitude }}</td>
                                                        <td>{{ $value->longitude }}</td>
                                                        <td>
                                                            @if ($value->status == 'pending')
                                                                <span class="badge badge-pending">Pending</span>
                                                            @elseif ($value->status == 'active')
                                                                <span class="badge badge-active">Active</span>
                                                            @elseif ($value->status == 'cancelled')
                                                                <span class="badge badge-cancel">Cancel</span>
                                                            @else
                                                                <span class="badge badge-unknown">Unknown</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $value->created_at->format('d-M-Y') }}</td>

                                                        <td>
                                                            {{-- <a href="{{ route('tracking.view', $value->id) }}" class="btn btn-primary">Track</a> --}}
                                                            <a href="{{ route('tracking.view', $value->id) }}"
                                                                class="btn btn-primary">
                                                                <i class="fas fa-map-marker-alt"></i> Track
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">No Tracking Available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->

                    {{-- <section class="col-lg-5 connectedSortable">

                        <!-- Map card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Location</h3>
                            </div>
                            <div class="card-body p-0">
                                <iframe src="https://www.google.com/maps?q=33.6844,73.0479&hl=es;z=14&output=embed"
                                    width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </section> --}}



                    <!-- Map Section -->
                    <section class="col-lg-5 connectedSortable mt-3">
                        <div class="row col-12">
                            <h4 class="mb-2"><b>Explore Location by Latitude & Longitude</b></h4>

                            <div class="mb-3 col-5">
                                <label for="latitude">Latitude:</label>
                                <input type="text" id="latitude" class="form-control" placeholder="Enter Latitude">
                            </div>
                            <div class="mb-3 col-5">
                                <label for="longitude">Longitude:</label>
                                <input type="text" id="longitude" class="form-control" placeholder="Enter Longitude">
                            </div>
                            <div class="col-2">
                                <button onclick="updateMap()" class="btn btn-primary mb-3">Show Location</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Location</h3>
                            </div>
                            <div class="card-body p-0">
                                <iframe id="mapFrame"
                                    src="https://www.google.com/maps?q=33.6844,73.0479&hl=es;z=14&output=embed"
                                    width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
    </main>
@endsection
@section('js')
    <script>
        function updateMap() {
            var lat = document.getElementById('latitude').value.trim();
            var lng = document.getElementById('longitude').value.trim();
            if (lat && lng) {
                var mapUrl = `https://www.google.com/maps?q=${lat},${lng}&hl=es;z=14&output=embed`;
                document.getElementById('mapFrame').src = mapUrl;
            } else {
                alert("Please enter both latitude and longitude.");
            }
        }
    </script>
@endsection
