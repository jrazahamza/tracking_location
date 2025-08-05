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
                        <h3 class="mb-0">Manage Users</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
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
                                    <h3 class="card-title">Manage Users</h3>
                                </div>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone no</th>
                                            <th>Address</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count() > 0)
                                            @foreach ($users as $key => $value)
                                                <tr class="align-middle">
                                                    <td>{{ ++$key }}</td>
                                                    <td><img src="{{ asset($value->profile ?? 'web/images/No_Image_Available.jpg') }}" alt="image" width="60" height="60"></td>
                                                    <td>{{ $value->full_name ?? '' }}</td>
                                                    <td>{{ $value->email ?? '' }}</td>
                                                    <td>{{ $value->phone_no ?? '' }}</td>
                                                    <td>{{ $value->street_address ?? '' }}</td>
                                                    <td>{{ $value->created_at->format('d-M-Y') }}</td>

                                                    <td>
                                                        <a href="{{ route('user.edit', $value->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <a href="{{ route('user.delete', $value->id) }}"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                                            <i class="fas fa-trash-alt"></i> Delete
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
                                    {{ $users->links('pagination::bootstrap-4') }}
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
