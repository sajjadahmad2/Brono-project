@extends('layouts.app')

@section('title', 'Permissions')
@section('css')

@endsection
@section("content")
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Property Permission</li>
                </ol>
            </div>
            <h4 class="page-title">Manage  Property Permissions</h4>
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
                            <p class="mb-1 text-muted">Total Permissions</p>
                            <input class=" h3 mt-0 mb-1 font-weight-semibold text-center" name="total_sales" id="total_sales" value="{{totalPropertyPermissions()}}" readonly style="background: transparent; border: none;margin-left: -30px">
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        @include('propertyPermissions.index')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on("change", ".permissions", function() {
            let elm = $(this);
            $.ajax({
                type: "GET",
                url: "{{ route('propertypermission.manage') }}",
                data: {
                    role : elm.data('role'),
                    permission : elm.data('permission'),
                },
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success(response.message)
                    }
                }
            });
        });

        var table = $('#datatables').DataTable({
            "sort": false,
            "ordering": false,
            "pagingType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            orderable: true,
            searchable: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });
    </script>
@endsection
