{{--
<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('dashboard') }}">
            <img alt="Logo" src="{{ logo('company_main_logo') }}" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ logo('company_small_logo') }}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate active"
            data-kt-toggle="false" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">

                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('dashboard') }}" >
                        <span class="menu-icon">
                          <img width="25" height="25" src="https://img.icons8.com/wired/64/ffffff/dashboard.png" alt="dashboard"/>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                @can('view role')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('role.list') }}" >
                        <span class="menu-icon">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/customer-insights-manager.png" alt="customer-insights-manager"/>
                        </span>
                        <span class="menu-title">Roles</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                @endcan
                <!--end:Menu item-->
                @can('view permission')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('permission.manage') }}" >
                        <span class="menu-icon">
                           <img width="25" height="25" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/ffffff/external-key-user-tanah-basah-basic-outline-tanah-basah.png" alt="external-key-user-tanah-basah-basic-outline-tanah-basah"/>
                        </span>
                        <span class="menu-title">Manage Permissions</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan
                @can('view user')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('user.list') }}" >
                        <span class="menu-icon">
                           <img width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/conference-call--v1.png" alt="conference-call--v1"/>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('manage settings')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('setting') }}" >
                        <span class="menu-icon">
                         <img width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/settings--v1.png" alt="settings--v1"/>
                        </span>
                        <span class="menu-title">Settings</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('manage designer')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('style.dashboard') }}" >
                        <span class="menu-icon">
                           <img width="25" height="25" src="https://img.icons8.com/external-pixer-icons-pack-dmitry-mirolyubov/44/ffffff/external-Designer-diy-pixer-icons-pack-dmitry-mirolyubov.png" alt="external-Designer-diy-pixer-icons-pack-dmitry-mirolyubov"/>
                        </span>
                        <span class="menu-title"> Designer </span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<!--end::Sidebar-->

--}}

<!--begin:Menu item-->

<div class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
    <a class="menu-link" href="{{ route('dashboard') }}">
        <span class="menu-title">Dashboard</span>
        <span class="menu-arrow d-lg-none"></span>
    </a>
</div>

<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
    class="menu-item  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
    <!--begin:Menu link-->
    <a class="menu-link" href="{{ route('dashboard') }}">
        <span class="menu-title">Features</span>
        <span class="menu-arrow d-lg-none"></span>
    </a>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
        <div class="menu-active-bg px-4 px-lg-0">
            <!--begin:Tabs nav-->
            <div class="d-flex w-100 overflow-auto">
                <ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                    <!--begin:Nav item-->
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link py-3 py-lg-6 active text-active-primary" href="#" data-bs-toggle="tab"
                            data-bs-target="#kt_app_header_menu_pages_pages">General</a>
                    </li>
                    <!--end:Nav item-->
                    <!--begin:Nav item-->
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab"
                            data-bs-target="#kt_app_header_menu_pages_account">Account</a>
                    </li>
                    <!--end:Nav item-->
                </ul>
            </div>
            <!--end:Tabs nav-->
            <!--begin:Tab content-->
            <div class="tab-content py-4 py-lg-8 px-lg-7">
                <!--begin:Tab pane-->
                <div class="tab-pane active w-lg-1000px" id="kt_app_header_menu_pages_pages">
                    <div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible"
                        data-kt-menu-dismiss="true">
                        <!--begin:Row-->
                        <div class="row">
                            <!--begin:Col-->
                            <div class="col-lg-8 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
                                <!--begin:Row-->
                                <div class="row">
                                    <!--begin:Col-->
                                    <div class="col-lg-6 mb-3">
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="{{ route('property.list') }}" class="menu-link active">
                                                <span
                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3"><img
                                                        src={{ asset('uploads/property.png') }}>
                                                </span>
                                                <span class="d-flex flex-column">
                                                    <span class="fs-6 fw-bold text-gray-800">Properties</span>
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
                                            <a href="{{ route('style.dashboard') }}" class="menu-link">
                                                <span
                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3"><img
                                                        src={{ asset('uploads/designer.png') }}>


                                                </span>
                                                <span class="d-flex flex-column">
                                                    <span class="fs-6 fw-bold text-gray-800">Designer</span>
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
                <!--end:Tab pane-->
                <!--begin:Tab pane-->
                <div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_account">
                    <div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible"
                        data-kt-menu-dismiss="true">
                        <!--begin:Row-->
                        <div class="row">
                            <!--begin:Col-->
                            <div class="col-lg-8 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
                                <!--begin:Row-->
                                <div class="row">
                                    <!--begin:Col-->
                                    @can('view user')
                                        <div class="col-lg-6 mb-3">
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="{{ route('user.list') }}" class="menu-link active">
                                                    <span
                                                        class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3"><img
                                                            src={{ asset('uploads/users.png') }}>
                                                    </span>
                                                    <span class="d-flex flex-column">
                                                        <span class="fs-6 fw-bold text-gray-800">User Management</span>
                                                    </span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                    @endcan
                                    <!--end:Col-->
                                    <!--begin:Col-->
                                    @can('view role')
                                        <div class="col-lg-6 mb-3">
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="{{ route('role.list') }}" class="menu-link">
                                                    <span
                                                        class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3"><img
                                                            src={{ asset('uploads/roles.png') }}>
                                                    </span>
                                                    <span class="d-flex flex-column">
                                                        <span class="fs-6 fw-bold text-gray-800">Role Mangement</span>
                                                    </span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                    @endcan
                                    <!--end:Col-->
                                    <!--begin:Col-->
                                    @can('view user')
                                    <div class="col-lg-6 mb-3">
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="{{ route('permission.manage') }}" class="menu-link active">
                                                <span
                                                    class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3"><img
                                                        src={{ asset('uploads/permissions.png') }}>
                                                </span>
                                                <span class="d-flex flex-column">
                                                    <span class="fs-6 fw-bold text-gray-800">Manage Permission</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                @endcan
                                       <!--end:Col-->
                                    <!--begin:Col-->

                                    @can('manage settings')
                                        <div class="col-lg-6 mb-3">
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="{{ route('setting') }}" class="menu-link">
                                                    <span
                                                        class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3"><img
                                                            src={{ asset('uploads/setting.png') }}>
                                                    </span>
                                                    <span class="d-flex flex-column">
                                                        <span class="fs-6 fw-bold text-gray-800">Settings</span>
                                                    </span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                    @endcan
                                    <!--end:Col-->
                                </div>
                                <!--end:Row-->
                            </div>
                            <!--end:Col-->

                        </div>
                        <!--end:Row-->
                    </div>
                </div>
                <!--end:Tab pane-->

            </div>
            <!--end:Tab content-->
        </div>
    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<!--begin:Menu item-->
{{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
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
                            <a href="{{ route('style.dashboard') }}"
                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                <img src="{{ asset('uploads/designer.png') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/atica.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/codeigniter.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
                                <span class="fw-semibold">Codeigniter</span>
                            </a>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-4">
                            <a href="#"
                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                <img src="{{ image('svg/brand-logos/bootstrap-4.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/disqus.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/figma-1.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
                                <span class="fw-semibold">Figma</span>
                            </a>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-4">
                            <a href="#"
                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                <img src="{{ image('svg/brand-logos/github.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
                                <span class="fw-semibold">Github</span>
                            </a>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-4">
                            <a href="#"
                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                <img src="{{ image('svg/brand-logos/gitlab.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/pinterest-p.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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

    <!--end:Menu sub-->
</div> --}}
<!--end:Menu item-->
<!--begin:Menu item-->
{{--  <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
    class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
    <!--begin:Menu link-->
    <a class="menu-link">
        <i class="fa fa-home" 'text-primary fs-2' aria-hidden="true"></i>
        <span class="menu-title">Properties</span>
        <span class="menu-arrow d-lg-none"></span>
    </a>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ 'property.add' }}" target="_blank"
                title="Check out over 200 in-house components, plugins and ready for use solutions"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-icon">{!! getIcon('rocket', 'fs-2') !!}</span>
                <span class="menu-title">Add Property</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

    </div>
    <!--end:Menu sub-->
</div>  --}}
<!--end:Menu item-->
