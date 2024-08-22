@extends('layouts.app')

@section('title', 'Add User')

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">Users</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
                <h4 class="page-title">Add New User</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.save') }}" method="POST" class="card-box">
                        @csrf
                        <div class="form-group row" hidden>
                            <div class="col-md-12">
                                <label for="for_role">For Role *</label>
                                <select name="role" class="form-control">
                                    <option>Please Select Role</option>
                                    @forelse($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @empty
                                    <option>Please Creat role first</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="first_name">First Name *</label>
                                <input type="text" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" id="first_name" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="last_name">Last Name *</label>
                                <input type="text" placeholder="First Name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" id="last_name" autocomplete="off">
                                @error('last_name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="email">Email *</label>
                                <input type="text" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" autocomplete="off">
                                @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="email">CRM Location ID *</label>
                                <input type="text" placeholder="Location ID" class="form-control @error('location_id') is-invalid @enderror" name="location_id" value="{{ old('location_id') }}" id="location_id" autocomplete="off">
                                @error('location_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password">Password *</label>
                                <input type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="password" autocomplete="off">
                                @error('password')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('user.list') }}" class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
