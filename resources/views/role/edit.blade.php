@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('role.list') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit Role</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Role</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('role.save', $data->id) }}" method="POST" class="card-box">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="id">Id</label>
                            <input type="text"  class="form-control"  name="id" value="{{ old('id', $data->id) }}" id="id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name">Name *</label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}" id="name" autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('role.list') }}" class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
