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
                <div class="card-header">
                    <h4 class="card-title">Role and Permissions Management</h4>
                </div>
                <div class="card-body">
                    <form id="roleForm" action="{{ route('role.save') }}" method="POST" class="card-box">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name">Role Name *</label>
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

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="permissions">Assign Permissions</label>
                                <table class="table mb-0 table-bordered table-hover" id="managePerm">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold">Permissions</th>
                                            <th class="fw-bold">Assign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $perm)
                                            <tr>
                                                <td>{{ $perm->name }}</td>
                                                <td>
                                                    <fieldset>
                                                        <div class="vs-checkbox-con vs-checkbox-success">
                                                            <div class="holder">
                                                                <div class="checkdiv grey400">
                                                                    <input type="checkbox" class="le-checkbox permissions"
                                                                        id="chkbox{{ $perm->id }}"
                                                                        value="{{ $perm->id }}" name="permissions[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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


        </div>
    </div>
@endsection
