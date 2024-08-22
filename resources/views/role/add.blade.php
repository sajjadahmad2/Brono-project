@extends('layouts.app')

@section('title', 'Add Role')
@section('css')
    <style>
        .checkdiv {
            position: relative;
            padding: 4px 8px;
            border-radius: 40px;
            margin-bottom: 4px;
            min-height: 30px;
            padding-left: 40px;
            display: flex;
            align-items: center;
        }

        .checkdiv:last-child {
            margin-bottom: 0px;
        }

        .checkdiv span {
            position: relative;
            vertical-align: middle;
            line-height: normal;
        }

        .le-checkbox {
            appearance: none;
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            background-color: #F44336;
            width: 30px;
            height: 30px;
            border-radius: 40px;
            margin: 0px;
            outline: none;
            transition: background-color .5s;
        }

        .le-checkbox:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            background-color: #ffffff;
            width: 20px;
            height: 5px;
            border-radius: 40px;
            transition: all .5s;
        }

        .le-checkbox:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            background-color: #ffffff;
            width: 20px;
            height: 5px;
            border-radius: 40px;
            transition: all .5s;
        }

        .le-checkbox:checked {
            background-color: #4CAF50;
        }

        .le-checkbox:checked:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) translate(-4px, 3px) rotate(45deg);
            background-color: #ffffff;
            width: 12px;
            height: 5px;
            border-radius: 40px;
        }

        .le-checkbox:checked:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) translate(3px, 2px) rotate(-45deg);
            background-color: #ffffff;
            width: 16px;
            height: 5px;
            border-radius: 40px;
        }
    </style>

@endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role.list') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
                <h4 class="page-title">Add New Role</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form id="roleForm" action="{{ route('role.save') }}" method="POST" class="card-box">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name">Name *</label>
                                <input type="text" placeholder="Name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" id="name" autocomplete="off">
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('role.list') }}"
                                class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card perm d-none">
                <div class="card-header">
                    <h4 class="card-title">Permissions Management</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <table class="table mb-0 table-bordered table-hover" id="managePerm">
                            <thead>
                                <tr>
                                    <th class="fw-bold">Permissions</th>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Available Permissions</th>
                                </tr>
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
        $(document).ready(function() {
            $('#roleForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: "{{ route('role.save') }}", // The route to save the role
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Show success message (optional, you can implement a better way to display messages)
                            alert(response.message);

                            // Hide the form card and show the permissions card
                            $('.card').not('.perm').hide();
                            $('.perm').removeClass('d-none').show();

                            // Load the permissions into the table
                            let permissionsHtml = '';
                            response.permissions.forEach(function(permission) {
                                permissionsHtml += `
                                    <tr>
                                        <td>${permission.name}</td>
                                        <td>
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-success">
                                                    <div class="holder">
                                                        <div class="checkdiv grey400">
                                                            <input type="checkbox" class="le-checkbox permissions"
                                                                id="chkbox_${permission.id}" value="1"
                                                                data-permission="${permission.id}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </td>
                                    </tr>`;
                            });
                            $('#managePerm tbody').html(permissionsHtml);
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors and display them to the user
                        const errors = xhr.responseJSON.errors;
                        for (let key in errors) {
                            alert(errors[key][
                                0
                            ]); // Replace this with a more user-friendly display
                        }
                    }
                });
            });
        });
        $(document).on("change", ".permissions", function() {
            let elm = $(this);
            $.ajax({
                type: "GET",
                url: "{{ route('permission.manage') }}",
                data: {
                    role: elm.data('role'),
                    permission: elm.data('permission'),
                },
                success: function(response) {
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
