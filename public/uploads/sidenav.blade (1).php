
<!--begin:Menu item-->
<div class="text-center text-gray-800 text-hover-primary bg-hover-light rounded  me-0 ml-10 me-lg-2">
    <a class="menu-link" href="{{ route('dashboard') }}">

        {{-- <a class="menu-link" href="{{ route('dashboard') }}"> --}}
            <span class="menu-title">Dashboard</span>
            <span class="menu-arrow d-lg-none"></span>
        </a>
</div>

<!--end:Menu item-->

<!--begin:Menu item-->
<div>
    @include('components.dashboard_menu')
</div>
<!--end:Menu item-->


<!--begin:Menu item-->
<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
    class="menu-item  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
    <!--begin:Menu link-->
    <a class="menu-link" href="{{ route('dashboard') }}">
        <span class="menu-title">Apps</span>
        <span class="menu-arrow d-lg-none"></span>
    </a>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
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
                            <a href="{{ route('property.list') }}"
                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                <img src="{{ asset('uploads/property.png') }}" class="w-25px h-25px mb-2" alt="" />
                                <span class="fw-semibold">PMS</span>
                            </a>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-4">
                            <a href="{{ route('style.dashboard') }}"
                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">

                                <img src="{{ asset('uploads/designer.png') }}" class="w-25px h-25px mb-2" alt="" />
                                <span class="fw-semibold">Designer</span>
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
                                <img src="{{ image('svg/brand-logos/atica.svg') }}" class="w-25px h-25px mb-2" alt="" />
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
                                <img src="{{ image('svg/brand-logos/dribbble-icon-1.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/google-podcasts.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
                                <img src="{{ image('svg/brand-logos/instagram-2-1.svg') }}" class="w-25px h-25px mb-2"
                                    alt="" />
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
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->


<!--begin:Menu item-->
<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
    class="menu-item  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
    <!--begin:Menu link-->
    <a class="menu-link" href="{{ route('dashboard') }}">
        <span class="menu-title">Settings</span>
        <span class="menu-arrow d-lg-none"></span>
    </a>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true" style="">
        {{--  <div class="separator my-2"></div>  --}}
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
                {{-- <span class="menu-arrow"></span> --}}
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
                    <a href="#" class="menu-link px-3 py-2 active" data-kt-element="mode" data-kt-value="light">
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
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
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
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
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
                        <img class="w-15px h-15px rounded-1 ms-2" src="{{ image('flags/united-states.svg') }}"
                            alt="" /></span>
                </span>
            </a>
            <!--begin::Menu sub-->
            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5 active">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ image('flags/united-states.svg') }}" alt="" />
                        </span>
                        English</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ image('flags/spain.svg') }}" alt="" />
                        </span>
                        Spanish</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ image('flags/germany.svg') }}" alt="" />
                        </span>
                        German</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ image('flags/japan.svg') }}" alt="" />
                        </span>
                        Japanese</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ image('flags/france.svg') }}" alt="" />
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
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/000000/settings--v1.png"
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
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="logout-btn">
                Sign Out
            </a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
</div>
