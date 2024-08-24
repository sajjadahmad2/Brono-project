@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
            <h4 class="page-title">Roles</h4>
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
                            <p class="mb-1 text-muted">Total Roles</p>
                            <input class=" h3 mt-0 mb-1 font-weight-semibold text-center" name="total_sales" id="total_sales" value="{{totalRoles()}}" readonly style="background: transparent; border: none;margin-left: -30px">
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>


<div class="row">
    @can('add role')
    <div class="col-md-12 text-right">
        <a href="{{ route('role.add') }}" class="btn btn-gradient-primary px-4 mt-0 mb-3"><i class="mdi mdi-plus-circle-outline mr-2"></i>Add New</a>
    </div>
    @endcan
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th class="text-right">Action</th>
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
                "url" : "{{ route('role.list') }}",
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
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
