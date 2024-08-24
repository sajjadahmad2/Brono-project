@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                <h4 class="page-title">Users</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
<div class="row">
    <div class=" m-2 col-lg-3">
        <div class="card" >
            <div class="card-body">
                <div class="row">
                    <div class="col-4 align-self-center">
                        <div class="icon-info">
                            <i data-feather="smile" class="align-self-center icon-lg icon-dual-warning"></i>
                        </div>
                    </div>
                    <div class="col-8 align-self-center text-right">
                        <div class="ml-2">
                            <p class="mb-1 text-muted">Total Users</p>
                            <input class=" h3 mt-0 mb-1 font-weight-semibold text-center" name="total_users" id="total_users" value="{{ totalUsers() }}" readonly style="background: transparent; border: none;margin-left: -30px">
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>


    <div class="row">
        @can('add user')
        <div class="col-md-12 text-right">
            <a href="{{ route('user.add') }}" class="btn btn-gradient-primary px-4 mt-0 mb-3"><i class="mdi mdi-plus-circle-outline mr-2"></i>Add New</a>
        </div>
        @endcan
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead class="thead-light" style="font-weight: bold">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Location ID</th>
                                <th>Status</th>
                                <th>Design Implications</th>
                                <th class="text-center">Action</th>
                            </tr><!--end tr-->
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
      
        // Datatable
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url" : "{{ route('user.list') }}",
            },
            columns: [
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'location_id', name: 'location_id'},
                {data: 'status', name: 'status'},
                 {data: 'enable_design', name: 'enable_design', orderable: false, searchable: false},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-right'
                },
            ]
        });
    </script>
@endsection
