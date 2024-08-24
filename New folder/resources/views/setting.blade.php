@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">Settings</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">

        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Copy Designer Script</h4>
                    {{-- just a div o write the <scritpt tag only with button of copy --}}
                    <div class="form-group row">
                        <div class="col-md-12">
                           <input type="text" class="form-control" id="dashboard_css" value="<script type='text/javascript' src='{{ asset('dashboard_css.js') }}'>  </script>">
                        </div>

                        <div class="col-md-12 mt-2">
                            <button class="btn btn-primary" onclick="copyScript()">Copy Script</button>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">General</h4>
                    <form action="{{ route('setting.save') }}" method="POST" class="card-box"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row" hidden>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" placeholder="Company Name" class="form-control"
                                        name="company_name" value="" id="company_name"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-3" hidden>
                                <div class="form-group">
                                    <label for="small_logo">Company Logo <span>(Small)</span></label>
                                    <input type="file" class="form-control dropify" name=""
                                        data-default-file="{{ logo('company_small_logo') }}" id="company_small_logo"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_logo">Company Logo <span>(Main)</span></label>
                                    <input type="file" class="form-control dropify" name="company_main_logo"
                                        id="company_main_logo" autocomplete="off"
                                        data-default-file="{{ logo('company_main_logo') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 mx-auto" hidden>
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Site Colors</h4>
                    <form action="{{ route('setting.save') }}" method="POST" class="card-box">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_prefix">Background Color</label>
                                    <input type="color" placeholder="Background Color" class="form-control"
                                        name="body_background_color" value="{{ setting('body_background_color') }}"
                                        id="body_background_color" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_prefix">Site Text Color</label>
                                    <input type="color" placeholder="Site Text Color" class="form-control"
                                        name="site_text_color" value="{{ setting('site_text_color') }}" id="site_text_color"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_prefix">Navbar <small> (Menu) </small></label>
                                    <input type="color" placeholder=" Navbar Background Color" class="form-control"
                                        name="navbar_background_color" value="{{ setting('navbar_background_color') }}"
                                        id="navbar_background_color" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_prefix"> Cards Colors</label>
                                    <input type="color" placeholder="Cards Colors" class="form-control" name="card_color"
                                        value="{{ setting('card_color') }}" id="card_color" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_prefix">Font-Family</label>
                                    <input type="text" placeholder="Font Family Name" class="form-control"
                                        name="font_family_name" value="{{ setting('font_family_name') }}"
                                        id="font_family_name" autocomplete="off">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 mx-auto"  hidden>
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Paste Custom CSS</h4>
                    <form action="{{ route('setting.save') }}" method="POST" class="card-box">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_prefix">Custom CSS</label>
                                    <textarea class="form-control editor simeditor" name="custom_css" placeholder=".className { background:red; }" rows="13">{{ setting('custom_css') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if(auth()->user()->hasRole('company'))
        
        <!--<div class="col-md-12 mx-auto" h>-->
        <!--        <div class="card">-->
        <!--            <div class="card-body">-->
        <!--                <h4 class="mt-0 header-title">Select Custom Menu Link Allowed Users</h4>-->

        <!--                <div class="form-group row">-->
        <!--                    <div class="col-md-12">-->
        <!--                        <div class="form-group row">-->
        <!--                            <div class="col-md-12">-->
        <!--                                <label for="category_prefix">Select Users</label>-->
        <!--                                <select class="select2 form-control select2-multiple" multiple="multiple"-->
        <!--                                    data-placeholder="Choose ..." name="allowed_users[]">-->
        <!--                                    @foreach ($ghl_users ?? [] as $gu)-->
        <!--                                        <option value="{{ $ghl_users->email }}"-->
        <!--                                            {{ in_array($user->email, json_decode(setting('allowed_users', '[]'))) ? 'selected' : '' }}>-->
        <!--                                            {{ $user->name }}</option>-->
        <!--                                    @endforeach-->
        <!--                                </select>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->


        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->


        <!--    </div>-->
            
            @endif


    </div>
@endsection

@section('js')
    <script>
        function copyScript() {
            var copyText = document.querySelector("#dashboard_css");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            toastr.success('Script copied to clipboard');
        }
    </script>
@endsection
