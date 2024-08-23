<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <title>XMS Panel | @yield('title')</title>
    <meta charset="utf-8" />
    <link rel="icon" href="{{ logo('company_main_logo', 1) }}" type="image/png">

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->


    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }} " rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--end::Global Stylesheets Bundle-->

    <style>
        .page-title-box {
            display: none
        }

        .text-right {
            text-align: right;
        }

        .form-group {
            margin-bottom: 1rem;
        }
    </style>

    @yield('css')

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">

    @php
        $user = auth()->user();
    @endphp
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
            <div id="kt_app_header" class="app-header" data-kt-sticky="true"
                data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
                data-kt-sticky-offset="{default: false, lg: '300px'}" style="animation-duration: 0.3s;">

                <!--begin::Header container-->
                <div class="app-container  container-fluid d-flex align-items-stretch justify-content-between "
                    id="kt_app_header_container">
                    <!--begin::Header mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                            <i class="ki-outline ki-abstract-14 fs-2"></i>
                        </div>
                    </div>
                    <!--end::Header mobile toggle-->

                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-1 me-lg-13">
                        <a href="{{ route('dashboard') }}">
                            <img alt="Logo" src="{{ logo('company_main_logo', auth()->id()) }}"
                                class="h-20px h-lg-30px theme-light-show">
                            <img alt="Logo" src="{{ logo('company_main_logo') }}"
                                class="h-20px h-lg-30px theme-dark-show">
                        </a>
                    </div>
                    <!--end::Logo-->

                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">

                        <!--begin::Menu wrapper-->
                        <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
                            <div class="app-header-menu app-header-mobile-drawer align-items-stretch"
                                data-kt-drawer="true" data-kt-drawer-name="app-header-menu"
                                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                                data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                                data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle"
                                data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}"
                                style="">
                                <!--begin::Menu-->
                                <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-600 menu-state-gray-900 menu-arrow-gray-500 fw-semibold fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0"
                                    id="#kt_app_header_menu" data-kt-menu="true">
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        @include('components.sidenav')
                                        <!--end:Menu link-->
                                    </div>
                                    {{-- <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        @include('htmls.ghl_anchor')
                                        <!--end:Menu link-->
                                    </div> --}}

                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--begin::Menu holder-->

                            <!--end::Menu holder-->
                        </div>
                        <!--end::Menu wrapper-->

                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">
                            <!--begin::User menu-->

                            <div class="app-navbar-item ms-1 ms-md-3">
                                <!--begin::Menu wrapper-->
                                <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end"><img src="{{ asset('uploads/apps.png') }}"
                                        class="w-25px h-25px mb-2" alt="" /></div>
                                <!--begin::My apps-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px"
                                    data-kt-menu="true">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <!--begin::Card title-->
                                            <div class="card-title">My Apps</div>
                                            <!--end::Card title-->

                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body py-5">
                                            <!--begin::Scroll-->
                                            <div class="mh-450px scroll-y me-n5 pe-5">
                                                <!--begin::Row-->
                                                <div class="row g-2">
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="{{ route('style.dashboard') }}"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ asset('uploads/designer.png') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">PMS</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/angular-icon-1.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">AngularJS</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        @include('htmls.ghl_anchor')
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/atica.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Atica</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/beats-electronics.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Music</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/codeigniter.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Codeigniter</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/bootstrap-4.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Bootstrap</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/google-tag-manager.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">GTM</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/disqus.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Disqus</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/dribbble-icon-1.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Dribble</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/google-play-store.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Play Store</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/google-podcasts.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Podcasts</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/figma-1.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Figma</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/github.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Github</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/gitlab.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Gitlab</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/instagram-2-1.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Instagram</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-4">
                                                        <a href="#"
                                                            class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                            <img src="{{ image('svg/brand-logos/pinterest-p.svg') }}"
                                                                class="w-25px h-25px mb-2" alt="" />
                                                            <span class="fw-semibold">Pinterest</span>
                                                        </a>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Scroll-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::My apps-->
                                <!--end::Menu wrapper-->
                            </div>

                            <div class="app-navbar-item" id="kt_header_user_menu_toggle">
                                <!--begin::Menu wrapper-->
                                <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-2"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <!--begin::User-->
                                    <div class="cursor-pointer symbol me-3 symbol-35px symbol-lg-45px">
                                        <img class="" src="{{ asset($user->photo) }}" alt="user">
                                    </div>
                                    <!--end::User-->

                                    <!--begin:Info-->
                                    <div class="me-4">
                                        <a href="{{ route('profile') }}"
                                            class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $user->first_name ?? 'Howdy!' }}</a>
                                    </div>
                                    <!--end:Info-->

                                    <i class="ki-outline ki-down fs-2 text-gray-500 pt-1"></i>
                                </div>


                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true" style="">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Profile Image" src="{{ asset($user->photo) }}">
                                            </div>
                                            <!--end::Avatar-->

                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">
                                                    {{ $user->first_name ?? 'Howdy' }}
                                                    <span
                                                        class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ $user->hasRole('admin') ? 'Admin' : 'Company' }}</span>
                                                </div>


                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="{{ route('profile') }}" class="menu-link px-5">
                                            My Profile
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title">My Subscription</span>
                                            {{--  <span class="menu-arrow"></span>  --}}
                                        </a>
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-5">Referrals</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-5">Billing</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-5">Payments</a>
                                            </div>
                                            <!--end::Menu item-->

                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title position-relative">
                                                Mode

                                                <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                                    <i class="ki-outline ki-night-day theme-light-show fs-2"></i> <i
                                                        class="ki-outline ki-moon theme-dark-show fs-2"></i> </span>
                                            </span>
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                            data-kt-menu="true" data-kt-element="theme-mode-menu" style="">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2 active"
                                                    data-kt-element="mode" data-kt-value="light">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <i class="ki-outline ki-night-day fs-2"></i> </span>
                                                    <span class="menu-title">
                                                        Light
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="dark">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <i class="ki-outline ki-moon fs-2"></i> </span>
                                                    <span class="menu-title">
                                                        Dark
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="system">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <i class="ki-outline ki-screen fs-2"></i> </span>
                                                    <span class="menu-title">
                                                        System
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->

                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title position-relative">Language
                                                <span
                                                    class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                                    <img class="w-15px h-15px rounded-1 ms-2"
                                                        src="{{ image('flags/united-states.svg') }}"
                                                        alt="" /></span>
                                            </span>
                                        </a>
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5 active">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1"
                                                            src="{{ image('flags/united-states.svg') }}"
                                                            alt="" />
                                                    </span>
                                                    English</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="{{ image('flags/spain.svg') }}"
                                                            alt="" />
                                                    </span>
                                                    Spanish</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="{{ image('flags/germany.svg') }}"
                                                            alt="" />
                                                    </span>
                                                    German</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="{{ image('flags/japan.svg') }}"
                                                            alt="" />
                                                    </span>
                                                    Japanese</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="{{ image('flags/france.svg') }}"
                                                            alt="" />
                                                    </span>
                                                    French</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->


                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title">Account Settings</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            @can('view role')
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-5" href="{{ route('role.list') }}">
                                                        <span class="menu-icon">
                                                            <img width="25" height="25"
                                                                src="https://img.icons8.com/ios/50/000000/customer-insights-manager.png"
                                                                alt="customer-insights-manager" />
                                                        </span>
                                                        <span class="menu-title">Roles</span>
                                                    </a>
                                                </div>
                                            @endcan
                                            <!--end::Menu item-->
                                            @can('view permission')
                                                <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                    <a class="menu-link px-5" href="{{ route('permission.manage') }}">
                                                        <span class="menu-icon">
                                                            <img width="25" height="25"
                                                                src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/000000/external-key-user-tanah-basah-basic-outline-tanah-basah.png"
                                                                alt="external-key-user-tanah-basah-basic-outline-tanah-basah" />
                                                        </span>
                                                        <span class="menu-title">Manage Permissions</span>
                                                    </a>
                                                </div>
                                            @endcan
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @can('view user')
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-5" href="{{ route('user.list') }}">

                                                        <span class="menu-icon">
                                                            <img width="25" height="25"
                                                                src="https://img.icons8.com/ios/50/000000/conference-call--v1.png"
                                                                alt="conference-call--v1" />
                                                        </span>
                                                        <span class="menu-title">Users</span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('manage settings')
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-5" href="{{ route('setting') }}">
                                                        <span class="menu-icon">
                                                            <img width="25" height="25"
                                                                src="https://img.icons8.com/ios/50/000000/settings--v1.png"
                                                                alt="settings--v1" />
                                                        </span>
                                                        <span class="menu-title">Settings</span>
                                                    </a>
                                                </div>
                                            @endcan
                                            <!--end::Menu item-->

                                        </div>
                                        <!--end::Menu sub-->
                                    </div>

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a class="button-ajax menu-link px-5"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            id="logout-btn">
                                            Sign Out
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->

                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->

                            <!--begin::Sidebar menu toggle-->
                            <!--end::Sidebar menu toggle-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>

            {{-- breadcrumb --}}
            <div class="app-wrapper  flex-column flex-row-fluid mt-5" id="kt_app_wrapper">

                <!--begin::Wrapper-->
                <div class="app-container  container-fluid d-flex ">

                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">


                            <!--begin::Content-->
                            <div id="kt_app_content" class="app-content ">
                                @yield('content')
                            </div>
                            <!--end::Content-->

                        </div>
                        <!--end::Content wrapper-->
                    </div>
                </div>
            </div>

            <!--begin::Footer-->
            <div id="kt_app_footer" style="padding:12px"
                class="app-footer  d-flex flex-column flex-md-row flex-center flex-md-stack pb-3 ">
                <!--begin::Copyright-->
                <div class="text-gray-900 order-2 order-md-1 mt-2 px-5">
                    <span class="text-muted fw-semibold me-1">2024©</span>
                    <a href="#" target="_blank" class="text-gray-800 text-hover-primary">XMS Admin
                        Panel</a>
                </div>
                <!--end::Copyright-->

                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                    <li class="menu-item"><a href="#" target="_blank" class="menu-link px-5">
                            Crafted with <i class="fas fa-heart text-danger px-3"></i> by XortLogiX</span>
                        </a>
                    </li>
                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end:::Main-->
    </div>
    <!--end::Wrapper-->

    <form id="logout-form" action="{{ route('logout') }}" method="post">
        @csrf
    </form>


    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }} "></script>
    <!--end::Global Javascript Bundle-->
    <script src=" https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script src=" {{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var logoutButton = document.getElementById('logout-btn');
            var logoutForm = document.getElementById('logout-form');

            if (logoutButton && logoutForm) {
                logoutButton.addEventListener('click', function() {
                    logoutForm.submit();
                });
            }
        });
    </script>



    <script>
        function deleteMsg(url) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        function statusMsg(url) {
            swal.fire({
                title: 'Are you sure?',
                text: "Don't Worry ! It Can be Revert",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Change the Status!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        function directMsg(url) {
            swal.fire({
                title: 'Are you sure?',
                text: "This automatic form will be directly published to your forms",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, publish this!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        function recommendMsg(url) {
            swal.fire({
                title: 'Are you sure?',
                text: "This Automatic form will be shown to the company as recommendation to use, it will be shown on the dashboard of the companies as well.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, recommend this!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        function designMsg(url) {
            swal.fire({
                title: 'Are you sure?',
                text: "This will change the dashboard design capability of the location.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, please proceed!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        function notifyMsg(url) {
            swal.fire({
                title: 'Are you sure?',
                text: "The Notification will be sent to the company for dues!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Send the Notification!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    location.href = url;
                }
            })
        }



        function showLoader() {
            const loaderHTML = `
                <div class="page-loader d-flex justify-content-center align-items-center bg-dark bg-opacity-25 position-fixed w-100 h-100" id="pageLoader">
                    <div class="text-center">
                        <span class="spinner-border text-primary" role="status"></span>
                        <span class="text-gray-800 fs-6 fw-semibold mt-5 d-block">Loading...</span>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', loaderHTML);
        }

        function hideLoader() {
            const loader = document.getElementById('pageLoader');
            if (loader) {
                loader.remove();
            }
        }



        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse or drop files here',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                },

            });
        });
    </script>



    @yield('js')

</body>
<!--end::Body-->

</html>
