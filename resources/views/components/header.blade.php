@php
    $user = auth()->user();
@endphp

<!--begin::Header-->
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
    data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
    data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('dashboard') }}" class="d-lg-none">
                <img alt="Logo" src="{{ image('logos/default-small.svg') }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                        class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <a class="menu-link"href="{{ route('dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
                            <div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible"
                                data-kt-menu-dismiss="true">
                                <!--begin:Row-->
                                <div class="row">
                                    <!--begin:Col-->
                                    <div class="  mb-lg-0    py-lg-6 px-lg-6">
                                        <!--begin:Row-->
                                        <div class="row">
                                            <!--begin:Col-->
                                            <div class="col-lg-6 mb-3">
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="{{ route('property.list') }}" class="menu-link active">
                                                        <span
                                                            class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                                            <i class="fa fa-home" 'text-primary fs-2'
                                                                aria-hidden="true"></i></span>
                                                        <span class="d-flex flex-column">
                                                            <span class="fs-6 fw-bold text-gray-800">Properties</span>
                                                            {{--  <span class="fs-7 fw-semibold text-muted">Reports & statistics</span>  --}}
                                                        </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Col-->
                                            <!--begin:Col-->

                                            <div class="col-lg-6 mb-3">
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <span
                                                            class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('color-swatch', 'text-success fs-1') !!}</span>
                                                        <span class="d-flex flex-column">
                                                            <span class="fs-6 fw-bold text-gray-800">Design</span>
                                                            {{--  <span class="fs-7 fw-semibold text-muted">Sales reports</span>  --}}
                                                        </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Col-->
                                        </div>
                                        <!--end:Row-->

                                    </div>
                                    <!--end:Col-->

                                </div>
                                <!--end:Row-->
                            </div>
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-title">My Apps</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <!--begin::My apps-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
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
                                                <a href="#"
                                                    class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                    <img src="{{ image('svg/brand-logos/amazon.svg') }}"
                                                        class="w-25px h-25px mb-2" alt="" />
                                                    <span class="fw-semibold">AWS</span>
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
                                                <a href="#"
                                                    class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                    <img src="{{ image('svg/brand-logos/atica.svg') }}"
                                                        class="w-25px h-25px mb-2" alt="" />
                                                    <span class="fw-semibold">Atica</span>
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

                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-title">Help</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div
                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link"
                                    href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"
                                    target="_blank"
                                    title="Check out over 200 in-house components, plugins and ready for use solutions"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                    data-bs-placement="right">
                                    <span class="menu-icon">{!! getIcon('rocket', 'fs-2') !!}</span>
                                    <span class="menu-title">Components</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs"
                                    target="_blank" title="Check out the complete documentation"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                    data-bs-placement="right">
                                    <span class="menu-icon">{!! getIcon('abstract-26', 'fs-2') !!}</span>
                                    <span class="menu-title">Documentation</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link"
                                    href="https://preview.keenthemes.com/laravel/metronic/docs/changelog"
                                    target="_blank">
                                    <span class="menu-icon">{!! getIcon('code', 'fs-2') !!}</span>
                                    <span class="menu-title">Changelog v8.2.6</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->


            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <!--begin::Search-->
                <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">
                </div>
                <!--end::Search-->
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        @if (Auth::user()->profile_photo_url)
                            <img src="{{ \Auth::user()->profile_photo_url }}" class="rounded-3" alt="user" />
                        @else
                            <div
                                class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()->name) }}">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    @if (Auth::user()->profile_photo_url)
                                        <img alt="Logo" src="{{ Auth::user()->profile_photo_url }}" />
                                    @else
                                        <div
                                            class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()->name) }}">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                    </div>
                                    <a href="#"
                                        class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
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
                            <a href="{{ route('profile') }}" class="menu-link px-5">My Profile</a>
                        </div>
                        <!--end::Menu item-->
                        {{--  <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-text">My Projects</span>
                                <span class="menu-badge">
                                    <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->  --}}
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

                        {{--  <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">My Statements</a>
                        </div>
                        <!--end::Menu item-->  --}}
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">Mode
                                    <span
                                        class="ms-5 position-absolute translate-middle-y top-50 end-0">{!! getIcon('night-day', 'theme-light-show fs-2') !!}
                                        {!! getIcon('moon', 'theme-dark-show fs-2') !!}</span></span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="light">
                                        <span class="menu-icon" data-kt-element="icon">{!! getIcon('night-day', 'fs-2') !!}</span>
                                        <span class="menu-title">Light</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="dark">
                                        <span class="menu-icon" data-kt-element="icon">{!! getIcon('moon', 'fs-2') !!}</span>
                                        <span class="menu-title">Dark</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="system">
                                        <span class="menu-icon" data-kt-element="icon">{!! getIcon('screen', 'fs-2') !!}</span>
                                        <span class="menu-title">System</span>
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
                                            src="{{ image('flags/united-states.svg') }}" alt="" /></span>
                                </span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5 active">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1" src="{{ image('flags/united-states.svg') }}"
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
                                <!--end::Menu item-->
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
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
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
                                <!--end::Menu item-->

                            </div>
                            <!--end::Menu sub-->
                        </div>

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a class="button-ajax menu-link px-5" href="#" data-action="{{ route('logout') }}"
                                data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true">
                                Sign Out
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->

                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::Header menu toggle-->
                <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                        id="kt_app_header_menu_toggle">
                        {!! getIcon('element-4', 'fs-1') !!}</div>
                </div>
                <!--end::Header menu toggle-->
                <!--begin::Aside toggle-->
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->

        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->


<script>
    // theme-switch
    console.log("shouod load")
    document.addEventListener("DOMContentLoaded", function() {
        var themeSwitchElements = document.querySelectorAll(".theme-switch");

        themeSwitchElements.forEach(function(element) {
            element.addEventListener("click", function(e) {
                e.preventDefault();
                var themeMode = this.getAttribute("data-kt-value");
                document.documentElement.setAttribute("data-theme", themeMode);
                localStorage.setItem("data-theme", themeMode);
                localStorage.setItem("data-theme-mode", themeMode);
            });
        });
    });
</script>
