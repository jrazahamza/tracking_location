@extends('dashboard.layouts.main')
@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tracking Requests</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tracking Requests</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">

                                <div class="row col-lg-12">
                                    <div class="mb-3 col-lg-2">
                                        <h3 class="card-title">Tracking Requests</h3>
                                    </div>

                                    <div class="col-lg-6">
                                        <a href="{{ route('tracking.requests', ['status' => 'active']) }}"
                                            class="btn btn-sm {{ $status == 'active' ? 'btn-primary' : 'btn-outline-primary' }}">Active</a>
                                        <a href="{{ route('tracking.requests', ['status' => 'pending']) }}"
                                            class="btn btn-sm {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">Pending</a>
                                        <a href="{{ route('tracking.requests', ['status' => 'cancelled']) }}"
                                            class="btn btn-sm {{ $status == 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }}">Cancelled</a>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
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
                                <div class="d-flex justify-content-end mt-4">
                                    {{ $trackingRequests->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
