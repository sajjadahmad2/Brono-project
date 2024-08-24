@extends('layouts.app')

@section('title', 'Profile')

@section('css')
  <style>
      .input-group-text{
          height : 100% !important;
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
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">User Profile</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
  <div class="row">
      <div class="col-md-8">
          <div class="card">
              <div class="card-body">
                  <h4 class="header-title mt-0"> General Settings</h4>
                  <form action="{{route('profile.save')}}" method="POST"  id="general_profile" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="photo">Photo <small>(Optional)</small></label>
                                  <input type="file" class="dropify" name="photo" id="photo"  data-default-file="{{ asset($user->photo) }}">
                              </div>
                          </div>
                      <div class="col-md-7">
                          <div class="form-group">
                              <label for="first_name">First Name</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" name="first_name" class="form-control"  autocomplete="off" autofocus="autofocus" value="{{ $user->first_name }}">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="last_name">Last Name</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" name="last_name" class="form-control"  autocomplete="off" autofocus="autofocus" value="{{ $user->last_name }}">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  </div>
                                  <input type="text" name="email" class="form-control"  autocomplete="off" autofocus="autofocus" value="{{ $user->email }}">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-12 text-right">
                                      <button type="submit" class="btn btn-primary px-4 mt-0 mb-0"> Save Information </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                  <h4 class="header-title mt-0"> Security </h4>
                  <form action="{{route('password.save')}}" method="POST"  id="">
                      @csrf
                      <div class="form-group">
                          <label for="current_password">Current Password *</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                              </div>
                              <input type="text" name="current_password" class="form-control"  autocomplete="off" autofocus="autofocus">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="new_password">New Password *</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                              </div>
                              <input type="text" name="password" class="form-control"  autocomplete="off" autofocus="autofocus">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="new_password">Confirm Password *</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                              </div>
                              <input type="text" name="confirm_password" class="form-control"  autocomplete="off" autofocus="autofocus">
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-12 text-right">
                                  <button type="submit" class="btn btn-warning px-4 mt-0 mb-0"> Change  </button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
