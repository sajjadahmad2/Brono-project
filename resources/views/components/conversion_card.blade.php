<!--begin::Card widget 8-->
<div class="card card-flush h-60">
    <!--begin::Header-->
    <div class="card-header py-7">
        <!--begin::Statistics-->
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center mb-2">
                <!--begin::Title-->
                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">Conversion Rates</span>
                <!--end::Title-->

                <!--begin::Badge-->
                <span class="badge badge-light-danger fs-base">
                    <i class="ki-outline ki-arrow-up fs-5 text-danger ms-n1"></i>
                    8.02%
                </span>
                <!--end::Badge-->
            </div>
            <!--end::Heading-->

            <!--begin::Description-->
            <span class="fs-6 fw-semibold text-gray-500">Conversion Calculations</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->

        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
            </button>


            <!--begin::Menu 2-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu separator-->
                <div class="separator mb-3 opacity-75"></div>
                <!--end::Menu separator-->

                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">
                        New Ticket
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">
                        New Customer
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                    <!--begin::Menu item-->
                    <a href="#" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu item-->

                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                Admin Group
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                Staff Group
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                Member Group
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">
                        New Contact
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu separator-->
                <div class="separator mt-3 opacity-75"></div>
                <!--end::Menu separator-->

                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary  btn-sm px-4" href="#">
                            Generate Reports
                        </a>
                    </div>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu 2-->

            <!--end::Menu-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body card-body d-flex justify-content-between flex-column pt-3 overflow-y-auto">
        @if (isset($cov_stats) && is_array($cov_stats))
        @foreach ($cov_stats as $key => $cov)
        @if ($key != 'users')
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Section-->
            <div class="d-flex align-items-center me-5">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <!-- You can replace this with an appropriate icon or image -->
                        <i class="ki-outline ki-icon fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->

                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $key }}</a>
                    <!--end::Title-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Section-->

            <!--begin::Wrapper-->
            <div class="d-flex align-items-center">
                <!--begin::Number-->
                <span class="text-gray-800 fw-bold fs-6 me-3">
                    {{ array_key_exists('Total', $cov) ? $cov['Total'] : 0 }}
                </span>
                <!--end::Number-->

                <!--begin::Info-->
                <div class="d-flex flex-center">
                    <!--begin::label-->
                    @if(array_key_exists('Percent', $cov))
                    <span class="badge badge-light-{{ $cov['Percent'] < 50 ? 'danger' : 'success' }} fs-base">
                        <i
                            class="ki-outline ki-arrow-{{ $cov['Percent'] < 50 ? 'down' : 'up' }} fs-5 text-{{ $cov['Percent'] < 50 ? 'danger' : 'success' }} ms-n1"></i>
                        {{ array_key_exists('Percent', $cov) ? $cov['Percent'] : 0 }}%
                    </span>
                    @endif
                    @if(array_key_exists('Conversion', $cov))
                    <span class="badge badge-light-{{ $cov['Conversion'] < 50 ? 'danger' : 'success' }} fs-base mr-1">
                        <i class="ki-outline ki-arrow-{{ $cov['Conversion'] < 50 ? 'down' : 'up' }} fs-5 text-{{ $cov['Conversion'] < 50 ? 'danger' : 'success' }} ms-n1"></i>

                        {{ array_key_exists('Conversion', $cov) ? $cov['Conversion'] : 0 }}%
                    </span>
                    @endif
                    <!--end::label-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Item-->

        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        @endif
        @endforeach
        @endif


    </div>
    <!--end::Body-->
</div>
<!--end::Card widget 8-->
