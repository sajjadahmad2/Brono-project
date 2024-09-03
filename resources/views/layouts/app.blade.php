<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <title>XMS Panel | @yield('title')</title>
    <meta charset="utf-8" />
    <link rel="icon" href="{{ logo('company_main_logo', 1) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.3/dist/flowbite.min.css" />

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
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <link href="https://keenthemes.com/metronic" rel="canonical" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
.flex-column-fluid {
    flex: 0 0 auto;
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
            <div class="main">
                <div id="kt_app_header" class="app-header" data-kt-sticky="true"
                    data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
                    data-kt-sticky-offset="{default: false, lg: '300px'}" style="animation-duration: 0.3s;">

                    <!--begin::Header container-->
                    <div class="app-container  container d-flex align-items-stretch justify-content-between "
                        id="kt_app_header_container">
                        <!--begin::Header mobile toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                            <div class="btn btn-icon btn-active-color-primary w-35px h-35px"
                                id="kt_app_header_menu_toggle">
                                <i class="ki-outline ki-abstract-14 fs-2"></i>
                            </div>
                        </div>

                        <!--end::Header mobile toggle-->

                        {{-- Logo --}}
                        <!--begin::Logo-->
                        <div class="d-flex align-items-center">
                            <a href="{{ route('dashboard') }}" hidden>
                                <img alt="Logo" src="{{ logo('company_main_logo', auth()->id()) }}"
                                    class="h-20px h-lg-30px theme-light-show">
                                <img alt="Logo" src="{{ logo('company_main_logo') }}"
                                    class="h-20px h-lg-30px theme-dark-show">
                            </a>

                            <!--begin::Menu-->

                            <div class="menu menu-rounded menu-column menu-lg-row   fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0"
                                id="kt_app_header_menu" data-kt-menu="true">
                                <div class="menu-item p-0 m-0">
                                    <!--begin:Menu link-->
                                    @include('components.sidenav')
                                    <!--end:Menu link-->
                                </div>

                            </div>
                            <!--end::Menu-->

                        </div>


                        <!--end:Menu item-->

                        <!--begin::Header wrapper-->
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                            id="kt_app_header_wrapper">

                            <!--begin::Menu wrapper-->
                            <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">

                                <!--begin::Menu holder-->

                                <!--end::Menu holder-->
                            </div>
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Header wrapper-->
                    </div>

                    <!--end::Header container-->

                </div>
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


        </div>
        <!--end:::Main-->
    </div>
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

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.3/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.3/dist/datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('js')
</body>
<!--end::Body-->

</html>
