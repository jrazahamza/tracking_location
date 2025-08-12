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
                        <h3 class="mb-0">Subscriptions</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
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

                                <div class="mb-3 col-lg-2">
                                    <h3 class="card-title">Subscriptions</h3>
                                </div>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S. No</th>
                                            @if (Auth::user()->role_id == 1)
                                                <th>User</th>
                                            @endif
                                            <th>Billing Cycle</th>
                                            <th>Amount</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Payment Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($subscriptions->count() > 0)
                                            @foreach ($subscriptions as $key => $value)
                                                <tr class="align-middle">
                                                    <td>{{ ++$key }}</td>
                                                    @if (Auth::user()->role_id == 1)
                                                        <td>{{ $value->user->full_name ?? '' }}</td>
                                                    @endif
                                                    <td>Monthly</td>
                                                    <td>{{ $value->amount ?? '' }}</td>
                                                    <td>{{ $value->start_date ?? '' }}</td>
                                                    <td>{{ $value->end_date ?? '' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge
                                                    @if ($value->payment_status == 'succeeded') bg-success
                                                    @elseif ($value->payment_status == 'succeeded') bg-success
                                                    @else bg-secondary @endif">
                                                            {{ ucfirst($value->payment_status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{-- active , trial_expired , expired , inactive --}}
                                                        <span
                                                            class="badge
                                                        @if ($value->status == 'active') bg-success
                                                        @elseif ($value->status == 'trial_expired') bg-warning
                                                        @elseif ($value->status == 'expired') bg-danger
                                                        @else bg-secondary @endif">
                                                            {{ ucfirst($value->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('subscription.cancel', $value->id) }}"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-ban"></i> Cancel
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
                                    {{ $subscriptions->links('pagination::bootstrap-4') }}
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
