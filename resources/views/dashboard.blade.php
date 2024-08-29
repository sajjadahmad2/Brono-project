@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.css"
        integrity="sha512-w3pXofOHrtYzBYpJwC6TzPH6SxD6HLAbT/rffdkA759nCQvYi5AHy5trNWFboZnj4xtdyK0AFMBtck9eTmwybg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .contacts_charts_container .card-toolbar {
            display: none !important;
        }

        .total_opportunities {
            display: none !important;
        }

        .apexcharts-legend-text {
            display: flex;
            gap: 10px;
        }

        .apexcharts-legend-marker {
            height: 8px !important;
            width: 13px !important;
            left: -3px !important;
            top: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class='contacts_charts_container'>
        <div class="row gx-5 gx-xl-10">

            {{-- Contacts filters row --}}
            <div class="col-xxl-4 offset-xxl-8 d-flex justify-content-end align-items-center" style="gap: 20px;">
                <!--begin::Col for user dropdown-->
                <div class="col-md-3 mb-3" style="
                width: 34%;
            "id="user-filter">
                    <select id="user-select" class="form-select">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->

                <!--begin::Col for tags dropdown-->
                <div class="col-md-3 mb-3" style="
                width: 20%;
            " id="tags-filter" hidden>
                    <select id="tags-select" class="form-select">
                        <option value="">Select Tag</option>

                    </select>
                </div>
                <!--end::Col-->

                <!--begin::Col for date range picker-->
                <div class="col mb-3" style="
                width: 20%;
            "id="date-range-filter">
                    <div id="date-range-picker" date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-start" name="start" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-end" name="end" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date end">
                        </div>
                    </div>

                </div>

            </div>



        </div>

        {{-- main stats --}}
        <div class="row gx-5 gx-xl-10 mb-xl-10">
            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">

                <!--begin::Card widget 4-->
                <div class="card card-flush h-md-50  mb-5 mb-xl-10">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <!--begin::Currency-->
                                <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start"></span>
                                <!--end::Currency-->

                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2 top_total_contact">LEADS</span>
                                <!--end::Amount-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Subtitle-->
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Total leads by TAG</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Card body-->
                    <div id="top_contacts_chart" style="min-width: 70px; " data-kt-size="70" data-kt-line="11"
                        class="p-5">

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 4-->

                <div class="conversiondiv h-60">
                    @include('components.conversion_card')
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">

                <!--begin::Card widget 4-->
                <div class="card card-flush h-md-50  mb-5 mb-xl-10">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <!--begin::Currency-->
                                <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start"></span>
                                <!--end::Currency-->

                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2 AverageYearlySales"></span>
                                <!--end::Amount-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Subtitle-->
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Average Yearly Sales</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Card body-->
                    <div id="top_avg_daily_sales_chart" style="min-width: 70px; " data-kt-size="70" data-kt-line="11"
                        class="p-5">

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 4-->

                <div class="card card-flush h-60 mb-xl-10">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span
                                class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ count($assigned_per_user) }}</span>
                            <!--end::Amount-->

                            <!--begin::Subtitle-->
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Users</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    @php
                        $visibleUsers = array_slice($users, 0, 12);
                        $remainingCount = count($users) - 12;
                    @endphp
                    <div class="card-body d-flex flex-column justify-content-end pe-0">
                        <!--begin::Title-->
                        <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Today’s Heroes</span>
                        <!--end::Title-->

                        <!--begin::Users group-->
                        <div class="symbol-group symbol-hover flex-nowrap">
                            <?php foreach ($visibleUsers as $user):
            $initials = strtoupper($user['firstName'][0] . $user['lastName'][0]);
            $bgColor = getRandomColor();
        ?>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                title="<?= $user['firstName'] . ' ' . $user['lastName'] ?>">
                                <span class="symbol-label" style="background-color: <?= $bgColor ?>; color: #fff;">
                                    <?= $initials ?>
                                </span>
                            </div>
                            <?php endforeach; ?>

                            <?php if ($remainingCount > 0): ?>
                            <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_view_users">
                                <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+
                                    <?= $remainingCount ?>
                                </span>
                            </a>
                            <?php endif; ?>
                        </div>
                        <!--end::Users group-->
                    </div>
                </div>

            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xxl-6">

                <div class="card card-flush  mb-5 mb-xl-10 h-5/6">
                    <!--begin::Card body-->
                    <div id="group_by_countries" style="min-width: 70px; min-height:95%" data-kt-size="340"
                        data-kt-line="22">
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 4-->

            </div>
            <!--end::Col-->

        </div>
    </div>


    <!--end::Col-->
    <div class="row gx-5 gx-xl-10 mt-xl-10">
        <!--begin::Col-->
        <div class="col-lg-8 col-xl-8 col-xxl-8 mb-5 mb-xl-0">
            <!--begin::Chart widget 3-->
            <div class="card card-flush overflow-hidden h-md-70">
                <!--begin::Header-->
                <div class="card-header py-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Sales This Months</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">All Won Opportunities</span>
                    </h3>
                    <!--end::Title-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                            data-kt-menu-overflow="true">

                            <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        </button>


                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->

                <!--begin::Card body-->
                <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                    <!--begin::Statistics-->
                    <div class="px-9 mb-5">
                        <!--begin::Statistics-->
                        <div class="d-flex mb-2">
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 top_total_sales"></span>
                        </div>
                        <!--end::Statistics-->


                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->

                    <!--begin::Chart-->
                    <div id="top_sales_chart" class="min-h-auto ps-4 pe-6" style="height: 300px; min-height: 315px;">

                    </div>
                    <!--end::Chart-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Col-->

        <div class="col-lg-4 col-xl-4 col-xxl-4 col-xxl- mb-5 mb-xl-10">
            <!--begin::List widget 9-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">CHANNELS</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">SALES BY CHANNEL</span>
                    </h3>
                    <!--end::Title-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="/metronic8/demo39/apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">Order
                            Details</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Icon-->
                                    <img src="	https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg"
                                        class="w-50px ms-n1 me-10" alt="">
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <a href="/metronic8/demo39/apps/ecommerce/catalog/edit-product.html"
                                        class="text-gray-800 text-4xl text-hover-primary fw-bold">25.896</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button
                                        class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">

                                        <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                    </button>

                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                Actions</div>
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
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-start">
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
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 text-1xl fw-bold">SALES Amount:
                                    <a href="/metronic8/demo39/apps/ecommerce/sales/details.html"
                                        class="text-gray-800  text-hover-primary fw-bold">
                                        € 109.272.272 </a>
                                </span>
                                <!--end::Name-->

                                <!--begin::Label-->
                                <span class="badge badge-light-success">Delivered</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Icon-->
                                    <img src="	https://preview.keenthemes.com/metronic8/demo39/assets/media/svg/brand-logos/instagram-2-1.svg"
                                        class="w-50px ms-n1 me-10" alt="">
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <a href="/metronic8/demo39/apps/ecommerce/catalog/edit-product.html"
                                        class="text-gray-800 text-4xl text-hover-primary fw-bold">3.412</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button
                                        class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">

                                        <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                    </button>

                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                Actions</div>
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
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-start">
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
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 text-1xl fw-bold">SALES Amount:
                                    <a href="/metronic8/demo39/apps/ecommerce/sales/details.html"
                                        class="text-gray-800  text-hover-primary fw-bold">
                                        € 291.752 </a>
                                </span>
                                <!--end::Name-->

                                <!--begin::Label-->
                                <span class="badge badge-light-primary">Shipping</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Icon-->
                                    <img src="	https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png"
                                        class="w-50px ms-n1 me-10" alt="">
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <a href="/metronic8/demo39/apps/ecommerce/catalog/edit-product.html"
                                        class="text-gray-800 text-4xl text-hover-primary fw-bold">2.855</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button
                                        class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">

                                        <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                    </button>

                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                Actions</div>
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
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-start">
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
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 text-1xl fw-bold">SALES Amount:
                                    <a href="/metronic8/demo39/apps/ecommerce/sales/details.html"
                                        class="text-gray-800  text-hover-primary fw-bold">
                                        € 52.154 </a>
                                </span>
                                <!--end::Name-->

                                <!--begin::Label-->
                                <span class="badge badge-light-danger">Confirmed</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Icon-->
                                    <img src="	https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/768px-Google_%22G%22_logo.svg.png"
                                        class="w-50px ms-n1 me-10" alt="">
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <a href="/metronic8/demo39/apps/ecommerce/catalog/edit-product.html"
                                        class="text-gray-800 text-4xl text-hover-primary fw-bold">3.212</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button
                                        class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">

                                        <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                    </button>

                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                Actions</div>
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
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-start">
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
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 text-1xl fw-bold">SALES Amount:
                                    <a href="/metronic8/demo39/apps/ecommerce/sales/details.html"
                                        class="text-gray-800  text-hover-primary fw-bold">
                                        € 52.154 </a>
                                </span>
                                <!--end::Name-->

                                <!--begin::Label-->
                                <span class="badge badge-light-success">Delivered</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Icon-->
                                    <img src="	https://seeklogo.com/images/G/gmail-new-2020-logo-32DBE11BB4-seeklogo.com.png"
                                        class="w-50px ms-n1 me-10" alt="">
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <a href="/metronic8/demo39/apps/ecommerce/catalog/edit-product.html"
                                        class="text-gray-800 text-4xl text-hover-primary fw-bold">25.896</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button
                                        class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">

                                        <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                    </button>

                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                Actions</div>
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
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-start">
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
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->


                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 text-1xl fw-bold">SALES Amount:
                                    <a href="/metronic8/demo39/apps/ecommerce/sales/details.html"
                                        class="text-gray-800  text-hover-primary fw-bold">
                                        € 52.154 </a>
                                </span>
                                <!--end::Name-->

                                <!--begin::Label-->
                                <span class="badge badge-light-primary">Shipping</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->

                        <!--end::Item-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 9-->
        </div>
    </div>

    <!--begin::Modal - View Users-->
    <div class="modal fade" id="kt_modal_view_users" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        {!! getIcon('cross', 'fs-1') !!}</div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">Browse Users</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">If you need more info, please check out our
                            <a href="#" class="link-primary fw-bold">Users Directory</a>.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->

                    <div class="mb-15">
                        <!--begin::List-->
                        <div class="mh-375px scroll-y me-n7 pe-7">
                            <!--begin::User-->
                            @foreach ($assigned_per_user as $key => $asu)
                                @php
                                    $key_split = explode('-', trim($key)); // Explode the name and email
                                    $name = $key_split[0] ?? 'X';
                                    $email = $key_split[1] ?? '';
                                    $initials = strtoupper(substr($name, 0, 1));
                                    $bgColor = getRandomColor();
                                    $total_sales = count($asu);
                                @endphp
                                <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                            title="{{ $name }}">
                                            <span class="symbol-label"
                                                style="background-color: {{ $bgColor }}; color: #fff;">{{ $initials }}</span>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <a href="#"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">{{ $name }}</a>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold text-muted">{{ $email }}</div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Stats-->
                                    <div class="d-flex">
                                        <!--begin::Sales-->
                                        <div class="text-end">
                                            @php
                                                $amount = 0;
                                                foreach ($asu as $key => $value) {
                                                    if ($value && ($value['status'] = 'won')) {
                                                        $amount += $value['monetary_value'] ?? 0;
                                                    }
                                                }
                                            @endphp
                                            <div class="fs-5 fw-bold text-gray-900">$ {{ $amount }}</div>
                                            <div class="fs-7 text-muted">Sales</div>
                                        </div>
                                        <!--end::Sales-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                            @endforeach
                            <!--end::User-->
                        </div>
                        <!--end::List-->
                    </div>
                    <!--end::Users-->
                    <!--begin::Notice-->
                    <div class="d-flex justify-content-between">
                        <!--begin::Label-->
                        <div class="fw-semibold">
                            <label class="fs-6">Adding Users by Team Members</label>
                            <div class="fs-7 text-muted">If you need more info, please check budget planning</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" checked="checked" />
                            <span class="form-check-label fw-semibold text-muted">Allowed</span>
                        </label>
                        <!--end::Switch-->
                    </div>
                    <!--end::Notice-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - View Users-->




@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.js"
        integrity="sha512-piY4QAXPoG2xLdUZZbcc5klXzMxckrQKY9A2o6nKDRt9inolvvLbvGPC+z9IZ29b28UJlD05B7CjxxPaxh4bjQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    @if (is_connected())
        <script>
            var start = moment().subtract(29, "days");
            var end = moment();

            function cb(start, end) {
                $(".date-range-picker").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            }

            $(".date-range-picker").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                        "month")]
                }
            }, cb);

            cb(start, end);
        </script>

        <script>
            /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                document.querySelector('.copy-script').addEventListener('click', function(e) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                    e.preventDefault();

                                                                                                                                                                                                                                                                                                                                                                                                                                                    const domain = window.location.origin;
                                                                                                                                                                                                                                                                                                                                                                                                                                                    const scriptContent = `<script src="${domain}/dashboard_css.js"><\/script>`;
                                                                                                                                                                                                                                                                                                                                                                                                                                                    const tempTextArea = document.createElement('textarea');
                                                                                                                                                                                                                                                                                                                                                                                                                                                    tempTextArea.value = scriptContent;
                                                                                                                                                                                                                                                                                                                                                                                                                                                    document.body.appendChild(tempTextArea);
                                                                                                                                                                                                                                                                                                                                                                                                                                                    tempTextArea.select();
                                                                                                                                                                                                                                                                                                                                                                                                                                                    document.execCommand('copy');
                                                                                                                                                                                                                                                                                                                                                                                                                                                    document.body.removeChild(tempTextArea);
                                                                                                                                                                                                                                                                                                                                                                                                                                                    toastr.success("script copied successfully!")
                                                                                                                                                                                                                                                                                                                                                                                                                                                }); */


            //ajax call to filter contacts
            // Function to handle the filtering logic
            function filterContacts() {
                const user = document.getElementById('user-select').value;
                const tag = document.getElementById('tags-select').value;
                const startDate = document.getElementById('datepicker-range-start').value;
                const endDate = document.getElementById('datepicker-range-end').value;

                // Combine the start and end dates into a single dateRange string if both are selected
                const dateRange = startDate && endDate ? `${startDate} - ${endDate}` : '';

                // Log values to check
                console.log(`User: ${user}, Tag: ${tag}, Date Range: ${dateRange}`);

                // Ajax call to filter contacts
                filterLoader(true);
                $.ajax({
                    url: "{{ route('filter.contacts') }}",
                    type: 'GET',
                    data: {
                        user: user,
                        tag: tag,
                        dateRange: dateRange
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            let tcc = response.top_stats;
                            console.log('Ye wala', tcc);
                            topContactsChart(tcc.contacts);
                            topSalesByMonths(tcc.sales);
                            topAverageYearlySales(tcc.sales.year_wise_sale_count);
                            countryWiseCharts(tcc.countrywise);
                            if (response.html) {
                                document.querySelector('.conversiondiv').innerHTML =
                                    ''; // Clear the existing content
                                document.querySelector('.conversiondiv').innerHTML = response
                                    .html; // Set the new HTML content
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {
                        filterLoader(false);
                    }
                });
            }

            // Attach the change event listeners to the inputs
            document.getElementById('user-select').addEventListener('change', filterContacts);
            document.getElementById('tags-select').addEventListener('change', filterContacts);
            // document.getElementById('datepicker-range-start').addEventListener('changeDate', filterContacts);
            document.getElementById('datepicker-range-end').addEventListener('changeDate', filterContacts);


            // Document ready function to reset date range picker and trigger filter on load
            $(document).ready(function() {
                // Empty the date range picker fields on page load
                $('#datepicker-range-start').val('');
                $('#datepicker-range-end').val('');

                // Automatically trigger the filter-results button click on page load
                //$('#filter-results').click();
            });
        </script>


        {{-- Contact Stats Charts --}}
        <script>
            //chart assigned by user contacts donut chart
            function assignedByUser(assignedUserData) {
                var seriesData = [];
                var xaxisData = [];
                for (const [key, value] of Object.entries(assignedUserData)) {
                    xaxisData.push(key);
                    seriesData.push(Object.keys(value).length);
                }

                var options = {
                    series: seriesData,
                    chart: {
                        width: 480,
                        type: 'donut',
                    },
                    labels: xaxisData,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#contactsassignedchart"), options);
                chart.render();
            }

            //contact chart on the total contact card
            function allContactsByDate(datewiseContacts) {
                var dates = Object.keys(datewiseContacts);
                var counts = Object.values(datewiseContacts);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Contacts',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Contacts'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#contact_datewise"), options);
                chart.render();
            }


            function contactBasedOnTags(groupedContactsByTags) {
                var seriesData = [];
                Object.keys(groupedContactsByTags).forEach((tag) => {
                    var contactCount = Object.keys(groupedContactsByTags[tag]).length;
                    seriesData.push({
                        x: tag,
                        y: contactCount
                    });
                });

                var options = {
                    chart: {
                        type: 'area',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x', // Enables zooming along the x-axis
                            autoScaleYaxis: true, // Automatically scales the Y-axis
                        },
                        toolbar: {
                            tools: {
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            }
                        }
                    },
                    series: [{
                        name: 'Contacts by Tags',
                        data: seriesData
                    }],
                    xaxis: {
                        type: 'category',
                        title: {
                            text: 'Tags'
                        },
                        labels: {
                            rotate: -45 // Rotate labels for better readability
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Contacts'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Contacts: " + val;
                            }
                        },
                        x: {
                            formatter: function(val) {
                                return "Tag: " + val;
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#grouped_contacts_by_tags"), options);
                chart.render();
            }

            //total contacts count
            // function totalContacts(total_contacts) {
            //     $('.total_contacts').text(total_contacts);
            // }

            // function countryWiseChartsss(countryWiseContacts) {

            //     am5.ready(function() {

            //         console.log(countryWiseContacts);

            //         // Data for leads by country
            //         var leadData = countryWiseContacts;

            //         // Create root and chart
            //         var root = am5.Root.new("group_by_countries");

            //         // Set themes
            //         root.setThemes([am5themes_Animated.new(root)]);

            //         // Create chart
            //         var chart = root.container.children.push(am5map.MapChart.new(root, {
            //             homeZoomLevel: 0.5,
            //             homeGeoPoint: {
            //                 longitude: 10,
            //                 latitude: 52
            //             }
            //         }));

            //         // Create world polygon series
            //         var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
            //             geoJSON: am5geodata_worldLow,
            //             exclude: ["AQ"]
            //         }));

            //         // Set up map polygons template
            //         worldSeries.mapPolygons.template.setAll({
            //             tooltipText: "{name}: {leads} leads",
            //             fill: am5.color(0xCCCCCC),
            //             nonScalingStroke: true,
            //             strokeOpacity: 0.5,
            //             strokeWidth: 0.5,
            //             label: 50
            //         });

            //         // Define color based on leads
            //         worldSeries.mapPolygons.template.adapters.add("fill", function(fill, target) {
            //             var dataItem = target.dataItem.dataContext;
            //             if (dataItem.leads > 0) {
            //                 return am5.color(0x00CC00); // Green color for countries with leads
            //             } else {
            //                 return am5.color(0xCCCCCC); // Grey color for countries with 0 or no leads
            //             }
            //         });

            //         // Add data to map
            //         worldSeries.data.setAll(leadData);

            //         worldSeries.events.on("datavalidated", () => {
            //             chart.goHome();
            //         });

            //     }); // end am5.ready()

            // }

            function countryWiseCharts(countryWiseContacts) {
                console.log("initialized map");
                console.log(countryWiseContacts);

                // Check if the root instance exists and dispose of it
                if (window.countryMapRoot) {
                    window.countryMapRoot.dispose();
                }

                am5.ready(function() {
                    // Create root and chart
                    var root = am5.Root.new("group_by_countries");

                    // Store the root instance in a global variable
                    window.countryMapRoot = root;

                    // Increase the size of the root container
                    root.container.setAll({
                        width: am5.percent(100),
                        height: am5.percent(100)
                    });

                    // Set themes
                    root.setThemes([am5themes_Animated.new(root)]);

                    // Create chart
                    var chart = root.container.children.push(am5map.MapChart.new(root, {
                        homeZoomLevel: 1.3, // Increase zoom level for a closer view
                        homeGeoPoint: {
                            longitude: 10, // Adjust longitude to center the map as desired
                            latitude: 52 // Adjust latitude to center the map as desired
                        }
                    }));

                    // Create world polygon series
                    var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
                        geoJSON: am5geodata_worldLow,
                        exclude: ["AQ"]
                    }));

                    // Set up map polygons template
                    worldSeries.mapPolygons.template.setAll({
                        tooltipText: "{name}: {leads} leads",
                        fill: am5.color(0xCCCCCC),
                        nonScalingStroke: true,
                        strokeOpacity: 0.5,
                        strokeWidth: 0.5
                    });

                    // Define color based on leads
                    worldSeries.mapPolygons.template.adapters.add("fill", function(fill, target) {
                        var dataItem = target.dataItem.dataContext;
                        if (dataItem.leads > 0) {
                            return am5.color("#1b84ff"); // Green color for countries with leads
                        } else {
                            return am5.color(0xCCCCCC); // Grey color for countries with 0 or no leads
                        }
                    });

                    // Add data to map
                    worldSeries.data.setAll(countryWiseContacts);

                    worldSeries.events.on("datavalidated", () => {
                        chart.goHome();
                    });
                }); // end am5.ready()
            }

            function filterLoader(showLoader = false) {
                let contactDiv = document.querySelector('.contacts_charts_container');
                let existingLoader = document.querySelector('.custom-loader');

                if (showLoader) {
                    // If no loader exists, create and append it
                    if (!existingLoader) {
                        let loader = document.createElement('div');
                        loader.className = 'custom-loader d-flex justify-content-center align-items-center';
                        loader.style.position = 'absolute';
                        loader.style.top = '0';
                        loader.style.left = '0';
                        loader.style.width = '100%';
                        loader.style.height = '100%';
                        loader.style.background = 'rgba(255, 255, 255, 0.8)';
                        loader.innerHTML = `
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`;
                        contactDiv.style.position = 'relative';
                        contactDiv.appendChild(loader);
                    }
                } else {
                    // Remove the loader if it exists
                    if (existingLoader) {
                        contactDiv.removeChild(existingLoader);
                    }
                }
            }


            function allChartsRender(response) {
                console.log(response.contact_stats, response.opportunities_stats, response.oppointment_stats, response
                    .call_stats);
                let assignedUserData = response.contact_stats['grouped_contacts'];
                let datewiseContacts = response.contact_stats['datewise_contacts'];
                let total_contacts = response.contact_stats['total_contacts'];
                let groupedContactsByTags = response.contact_stats['grouped_contacts_by_tags'];
                let conuntrywise = response.contact_stats['group_by_countries'];
                totalContacts(total_contacts);
                assignedByUser(assignedUserData);
                allContactsByDate(datewiseContacts);
                contactBasedOnTags(groupedContactsByTags);
                countryWiseCharts(conuntrywise);
                daywise_count(response.opportunities_stats['daywise_count']);
                opportunities_assigned_per_user(response.opportunities_stats['opportunities_assigned_per_user']);
                //opportunities_by_source(response.opportunities_stats['opportunities_by_source']);
                opportunities_by_status(response.opportunities_stats['opportunities_by_status']);
                monetary_value_distribution(response.opportunities_stats['monetary_value_distribution']);
                pipelinewiseopportunities(response.opportunities_stats['pipelineswise']);
                showTotalOpportunities(response.opportunities_stats['total_opportunities']);
                leadToSaleConversionChart(response.opportunities_stats['lead_to_sale']);
                appointments_by_status(response.oppointment_stats['appointments_by_status']);
                appointments_assigned_per_user(response.oppointment_stats['appointments_assigned_per_user']);
                appointments_by_source(response.oppointment_stats['appointments_by_source']);
                appointments_by_daywise(response.oppointment_stats['daywise_count']);
                showTotalAppointments(response.oppointment_stats['total_appointments']);
                appointments_by_calendars(response.oppointment_stats['appointments_by_calendars']);
                calls_by_daywise(response.call_stats['daywise_count']);
                showTotalCalls(response.call_stats['total_calls']);
            }

            //call all the charts
        </script>


        {{-- Opportunities Stats Charts --}}
        <script>
            function daywise_count(daywise_count) {
                var dates = Object.keys(daywise_count);
                var counts = Object.values(daywise_count);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Opportunities',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Opportunities'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#daywise_count_chart"), options);
                chart.render();
            }

            function opportunities_assigned_per_user(opportunities_assigned_per_user) {
                var seriesData = [];
                var xaxisData = [];
                for (const [key, value] of Object.entries(opportunities_assigned_per_user)) {
                    xaxisData.push(key);
                    seriesData.push(Object.keys(value).length);
                }

                var options = {
                    series: seriesData,
                    chart: {
                        width: 480,
                        type: 'donut',
                    },
                    labels: xaxisData,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#opportunities_assigned_per_user_chart"), options);
                chart.render();
            }


            function opportunities_by_status(opportunities_by_status) {

                var labels = Object.keys(opportunities_by_status);
                var values = Object.values(opportunities_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#opportunities_by_status_chart"), options);
                chart.render();
            }

            function monetary_value_distribution(data) {

                var dates = data.dates;
                var revenue_values = data.revenue;
                var lost_values = data.lost;
                var expected_values = data.expected;

                var options = {
                    series: [{
                            name: 'Revenue',
                            data: revenue_values
                        },
                        {
                            name: 'Lost',
                            data: lost_values
                        },
                        {
                            name: 'Expected',
                            data: expected_values
                        }
                    ],
                    chart: {
                        type: 'line',
                        height: 350
                    },
                    xaxis: {
                        categories: dates,
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Amount'
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#monetary_value_distribution_chart"), options);
                chart.render();
            }

            //pipelines wise opportunities
            function pipelinewiseopportunities(pipelinesWise) {
                const pipelines = Object.keys(pipelinesWise);
                const stages = new Set();
                const seriesData = [];

                pipelines.forEach(pipeline => {
                    const stagesData = pipelinesWise[pipeline];
                    Object.keys(stagesData).forEach(stage => stages.add(stage));
                });

                const stageArray = Array.from(stages);

                stageArray.forEach(stage => {
                    seriesData.push({
                        name: stage,
                        data: pipelines.map(pipeline => {
                            return pipelinesWise[pipeline][stage] || 0;
                        })
                    });
                });

                const options = {
                    chart: {
                        type: 'bar',
                        height: 400,
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '60%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    series: seriesData,
                    xaxis: {
                        categories: pipelines,
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Opportunities'
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                    }
                };

                const chart = new ApexCharts(document.querySelector("#pipelines_wise_chart"), options);
                chart.render();

            }

            function showTotalOpportunities(total_opportunities) {
                $('#total_opportunities').text(total_opportunities);
            }


            function leadToSaleConversionChart(leadToSale) {
                $('#total_opportunities_conversion').text(leadToSale.conversion_rate + '%');
                const chartOptions = {
                    chart: {
                        type: 'donut',
                        height: 300
                    },
                    series: [
                        leadToSale.won,
                        leadToSale.contacts - leadToSale.won
                    ],
                    labels: ['Won Leads', 'Not Converted'],
                    colors: ['#1cc88a', '#e74a3b']
                };

                var chart = new ApexCharts(document.querySelector("#lead_to_sale_count_chart"), chartOptions);
                chart.render();
            }

            //call the charts
            // let opportunitiesStats = {!! json_encode($opportunities_stats) !!};
            // daywise_count(opportunitiesStats['daywise_count']);
            // opportunities_assigned_per_user(opportunitiesStats['opportunities_assigned_per_user']);
            // // opportunities_by_source(opportunitiesStats['opportunities_by_source']);
            // opportunities_by_status(opportunitiesStats['opportunities_by_status']);
            // monetary_value_distribution(opportunitiesStats['monetary_value_distribution']);
            // pipelinewiseopportunities(opportunitiesStats['pipelineswise']);
            // showTotalOpportunities(opportunitiesStats['total_opportunities']);
            // leadToSaleConversionChart(opportunitiesStats['lead_to_sale']);
        </script>


        {{-- Appointments Stats Charts --}}
        <script>
            /*
                                                                                                                                                                                                                                                                                                                                                      {"total_appointments":2,"appointments_by_status":{"confirmed":2},"appointments_by_source":{"booking_widget":1,"calendar_page":1},"appointments_assigned_per_user":{"Zulkifal Hassan":[],"Pervaiz Malik":[],"Usman Zaheer ":[],"Awais Saleem":[],"Muhammad Orhan":[],"Shoaib Sultan":[],"Abraham Peter":[],"Sabir Shah":[],"M Safian ":[],"Ali Hassan":[],"Ayaz Khan":[],"Awais Qarni":[],"Saqib Ali":[],"M Waseem":[],"Faiza Bibi":[],"Anwar Hussain":{"1":{"id":2,"ghl_appointment_id":"4ngL3x1hQ6HCmZ2P7c6T","location_id":"vcLxBfw01Nmv2VnlhtND","address":"https:\/\/us05web.zoom.us\/j\/85875585824?pwd=aJwbFon5VxBME9Za9NNox0xa0qpGyC.1","title":"Test Oppointment","calendar_id":"wmquOnn9rm2Su0KI16IO","contact_id":"btDRSwAYUrxjTwHx6hul","group_id":null,"appointment_status":"confirmed","assigned_user_id":"tAeeuUTKOCuOwo4jjzlo","users":null,"notes":null,"source":"calendar_page","start_time":"2024-08-20 10:00:00","end_time":"2024-08-20 10:30:00","date_added":"2024-08-19 18:40:30","date_updated":null,"deleted_at":null,"created_at":"2024-08-19T18:40:33.000000Z","updated_at":"2024-08-19T18:40:33.000000Z"}},"M Usman Ali":[],"Rehmat Faizan":[]},"daywise_count":{"2023-09-25":1,"2024-08-19":1},"appointments_by_calendars":{"faiza test neww":[],"appointment book 1":[],"robin calendar":[],"Robin calendar Safian":[],"haider":[],"Waseem training Pract-1":[],"Beard":[],"safian test":[],"faiza-new":[],"Practice-2":[],"faiza":[],"High Medium Low":[],"test anwar":[],"appointment book":[],"Book An Appointment":[],"book appointment":[],"Select Date And Time":[],"Sabir Roof Replacement Booking Calendar":[],"Simple calender":[],"SAA Delivery":[],"calander":[],"Sabir Free Roof Inspection Calendar":[],"simple calendar":[],"anwar multi members":[],"Faiza-simple calendar":[],"Cutting":[],"Collective":[],"Anwar calendar Test":[],"Neat Feat Podiatry Calender ":[],"Free Roof Inspection Calendar":[],"Bingo":[],"Unlock Your Business Potential with Expert Consultation!":[],"ali calander":[],"collective calendar":[],"test Anwar":[],"Appointment With Saqib":[],"Team Calendar":[],"class calendar":[],"faiza- practice":[],"appointment booking":[],"Cutting and Beard":[],"Anwaar 1st calender":[],"haider calander":[],"Bingo 2":[],"Faiza- round robin":[],"roof maintenance":[],"faiza-practice":[],"Round Robin":[],"Testing calendar":[],"anwar work":[{"id":1,"ghl_appointment_id":"0007BWpSzSwfiuSl0tR2","location_id":"vcLxBfw01Nmv2VnlhtND","address":"https:\/\/example.com\/meeting","title":"Appointment with GHL Dev team","calendar_id":"wmquOnn9rm2Su0KI16IO","contact_id":"vcLxBfw01Nmv2VnlhtND","group_id":"9NkT25Vor1v4aQatFsv2","appointment_status":"confirmed","assigned_user_id":"YlWd2wuCAZQzh2cH1fVZ","users":"[\"YlWd2wuCAZQzh2cH1fVZ\",\"9NkT25Vor1v4aQatFsv2\"]","notes":"Some dummy note","source":"booking_widget","start_time":"2023-09-25 16:00:00","end_time":"2023-09-25 16:00:00","date_added":"2023-09-25 16:00:00","date_updated":null,"deleted_at":null,"created_at":"2024-08-19T18:36:30.000000Z","updated_at":"2024-08-19T18:36:30.000000Z"},{"id":2,"ghl_appointment_id":"4ngL3x1hQ6HCmZ2P7c6T","location_id":"vcLxBfw01Nmv2VnlhtND","address":"https:\/\/us05web.zoom.us\/j\/85875585824?pwd=aJwbFon5VxBME9Za9NNox0xa0qpGyC.1","title":"Test Oppointment","calendar_id":"wmquOnn9rm2Su0KI16IO","contact_id":"btDRSwAYUrxjTwHx6hul","group_id":null,"appointment_status":"confirmed","assigned_user_id":"tAeeuUTKOCuOwo4jjzlo","users":null,"notes":null,"source":"calendar_page","start_time":"2024-08-20 10:00:00","end_time":"2024-08-20 10:30:00","date_added":"2024-08-19 18:40:30","date_updated":null,"deleted_at":null,"created_at":"2024-08-19T18:40:33.000000Z","updated_at":"2024-08-19T18:40:33.000000Z"}],"OutBound Calender":[]}}
                                                                                                                                                                                                                                                                                                                                                    */

            function appointments_by_status(appointments_by_status) {
                var labels = Object.keys(appointments_by_status);
                var values = Object.values(appointments_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#appointments_by_status_chart"), options);
                chart.render();
            }

            function appointments_assigned_per_user(appointments_assigned_per_user) {
                var seriesData = [];
                var xaxisData = [];
                for (const [key, value] of Object.entries(appointments_assigned_per_user)) {
                    xaxisData.push(key);
                    seriesData.push(Object.keys(value).length);
                }

                var options = {
                    series: seriesData,
                    chart: {
                        width: 480,
                        type: 'donut',
                    },
                    labels: xaxisData,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#appointments_assigned_per_user_chart"), options);
                chart.render();
            }

            function appointments_by_source(appointments_by_source) {
                var seriesData = [];
                var labels = [];

                Object.keys(appointments_by_source).forEach((source) => {
                    console.log(source);
                    console.log(appointments_by_source[source]);
                    var appointmentCount = appointments_by_source[source];
                    seriesData.push(appointmentCount);
                    labels.push(source);
                });


                var options = {
                    chart: {
                        type: 'pie',
                        height: 280
                    },
                    series: seriesData,
                    labels: labels,
                    colors: ['#f3a4b5', '#ffbb33', '#34bfa3'],
                    dataLabels: {
                        enabled: true
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Appointments: " + val;
                            }
                        },
                        x: {
                            formatter: function(val) {
                                return "Source: " + val;
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#appointments_by_source_chart"), options);
                chart.render();
            }

            function appointments_by_daywise(appointments_by_daywise) {
                var dates = Object.keys(appointments_by_daywise);
                var counts = Object.values(appointments_by_daywise);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Appointments',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Appointments'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#appointment_by_daywise"), options);
                chart.render();
            }


            //appointment calendars
            function appointments_by_calendars(appointments_by_calendars) {
                var labels = [];
                var data = [];

                // Transform data for the polar area chart
                Object.keys(appointments_by_calendars).forEach((calendar) => {
                    var appointmentCount = Object.keys(appointments_by_calendars[calendar]).length;
                    labels.push(calendar);
                    data.push(appointmentCount);
                });

                var options = {
                    chart: {
                        type: 'polarArea',
                        height: 500
                    },
                    series: data,
                    labels: labels,
                    colors: ['#f3a4b5', '#ffbb33', '#34bfa3', '#ff4560', '#00e396', '#775dd0', '#546e7a', '#d4526e',
                        '#308a6d', '#a5b1c2'
                    ],
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#000'] // Adjust color for better contrast
                        }
                    },
                    plotOptions: {
                        polarArea: {
                            rings: {
                                strokeWidth: 0 // Optional: Hide the rings
                            }
                        }
                    },
                    legend: {
                        position: 'bottom' // Place legend at the bottom
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Appointments: " + val;
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 400 // Adjust height on smaller screens
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#appointments_calendar_wise_chart"), options);
                chart.render();
            }


            function showTotalAppointments(total_appointments) {
                $('#appointments_by_source').text(total_appointments);
            }

            //call the charts
            // let appointmentsStats = {!! json_encode($oppointment_stats) !!};
            // console.log(appointmentsStats);
            // appointments_by_status(appointmentsStats['appointments_by_status']);
            // appointments_assigned_per_user(appointmentsStats['appointments_assigned_per_user']);
            // appointments_by_source(appointmentsStats['appointments_by_source']);
            // appointments_by_daywise(appointmentsStats['daywise_count']);
            // showTotalAppointments(appointmentsStats['total_appointments']);
            // appointments_by_calendars(appointmentsStats['appointments_by_calendars']);
        </script>


        {{-- Calls Stats Charts --}}
        <script>
            function calls_by_daywise(calls_by_daywise) {
                var dates = Object.keys(calls_by_daywise);
                var counts = Object.values(calls_by_daywise);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Calls',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Calls'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#calls_by_daywise"), options);
                chart.render();
            }

            function showTotalCalls(total_calls) {
                $('#total_calls').text(total_calls);
            }

            //call the charts
            // let callsStats = {!! json_encode($call_stats) !!};
            // calls_by_daywise(callsStats['daywise_count']);
            // showTotalCalls(callsStats['total_calls']);
        </script>

        {{-- top stats charts --}}

        <script>
            function topContactsChart(topStats) {
                // Update the total contacts display
                document.querySelector('.top_total_contact').innerHTML = topStats.total_contacts;



                // Define the options for the new chart
                var options = {
                    dataLabels: {
                        enabled: false,
                        formatter: function(val) {
                            return val + "%"
                        },

                    },
                    chart: {
                        type: 'donut',
                        height: 120, // Keep the height as is to fit within the card
                        width: '100%',
                        events: {
                            mounted: function(chartContext, config) {
                                // After the chart is rendered, replace the class
                                var legendTexts = document.querySelectorAll('.apexcharts-legend-text');
                                legendTexts.forEach(function(legendText) {
                                    legendText.classList.remove('apexcharts-legend-text');
                                    legendText.classList.add('text-gray-500', 'flex-grow-1', 'me-4', "fs-6",
                                        "gap-4", "d-flex", "align-item-center", "justify-between");
                                });

                            }
                        } // Ensure the chart fits within the card's width
                    },
                    series: [
                        topStats.total_contacts,
                        topStats.agencies,
                        topStats.leads,
                        topStats.recruitment,
                        topStats.no_tags,
                        topStats.sollicitants
                    ],
                    labels: [
                        'Total Contacts',
                        'Agencies',
                        'Leads',
                        'Recruitment',
                        'No Tags',
                        'Sollicitants'
                    ],
                    colors: ["#f8285a", "#1b84ff", "#e4e6ef"],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '60%'
                            }
                        }
                    },
                    legend: {
                        position: 'right', // Position the legend to the right of the chart
                        fontSize: '10px', // Adjust the font size to fit the legend within the small card
                        offsetY: 0, // Ensure the legend is vertically centered
                        itemMargin: {
                            horizontal: 0,
                            vertical: 10
                        },
                        formatter: function(seriesName, opts) {
                            return `
                                 <div style="font-weight:600">${seriesName}</div>
                                 <div class="fw-bolder text-gray-700 text-xxl-end fs-6">${opts.w.globals.series[opts.seriesIndex]}</div>
                                `;
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 150 // Reduce the height on smaller screens
                            },
                            legend: {
                                position: 'bottom', // Move legend below on smaller screens
                                offsetY: 0,
                                itemMargin: {
                                    horizontal: 5,
                                    vertical: 5
                                }
                            }
                        }
                    }]
                };
                if (window.topContactsChartInstance) {
                    window.topContactsChartInstance.destroy();
                }
                // Create and render the new chart, storing the instance globally
                window.topContactsChartInstance = new ApexCharts(document.querySelector("#top_contacts_chart"), options);
                window.topContactsChartInstance.render();
            }






            function top_opportunities_by_status(total = 0, opportunities_by_status) {
                document.querySelector('.top_total_opportunity').innerHTML = total;
                var labels = Object.keys(opportunities_by_status);
                var values = Object.values(opportunities_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 180
                    },
                    labels: labels,
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 180,
                        options: {
                            chart: {
                                height: 180
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#top_opportunities_chart"), options);
                chart.render();
            }

            function top_appointments_by_status(total = 0, appointments_by_status) {
                document.querySelector('.top_total_oppointments').innerHTML = total;
                var labels = Object.keys(appointments_by_status);
                var values = Object.values(appointments_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#top_total_appointments"), options);
                chart.render();
            }

            function topSalesByMonths(saleByMonth) {
                // Update the total sales display
                document.querySelector('.top_total_sales').innerText = saleByMonth.total;

                // Extract dates and counts from the saleByMonth object
                var dates = Object.keys(saleByMonth.won_opportunities);
                var counts = Object.values(saleByMonth.won_opportunities);

                // Destroy the existing chart if it exists
                if (window.topSalesChart) {
                    window.topSalesChart.destroy();
                }

                // Define the options for the new chart
                var options = {
                    chart: {
                        type: 'line',
                        height: 350,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: false
                        },

                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Total Sales',
                        data: counts
                    }],
                    colors: ['#17c653'],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Sales'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                    },
                    markers: {
                        size: 0, // This removes the markers from the chart
                        hover: {
                            size: 0 // This ensures no markers appear on hover
                        }
                    },

                    grid: {
                        row: {
                            colors: ['transparent', 'transparent'], // Alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                // Create and render the new chart, storing the instance globally
                window.topSalesChart = new ApexCharts(document.querySelector("#top_sales_chart"), options);
                window.topSalesChart.render();
            }


            function top_calls_by_status(total = 0, calls_by_status) {
                document.querySelector('.top_total_calls').innerHTML = total;
                var labels = Object.keys(calls_by_status);
                var values = Object.values(calls_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#top_total_calls"), options);
                chart.render();
            }

            function topAverageYearlySales(dailySalesPercentages) {
                // Calculate the total sum of the percentages
                const total = Object.values(dailySalesPercentages).reduce((sum, value) => sum + value, 0);
                document.querySelector('.AverageYearlySales').innerText = '$ ' + total;

                // Extract labels and data from the dailySalesPercentages object
                const labels = Object.keys(dailySalesPercentages);
                const data = Object.values(dailySalesPercentages);

                // Destroy the existing chart if it exists
                if (window.topAvgDailySalesChart) {
                    window.topAvgDailySalesChart.destroy();
                }

                // Define the options for the new chart
                const options = {
                    chart: {
                        type: 'bar',
                        height: 220,
                    },
                    series: [{
                        name: 'Yearly Sales Percentages',
                        data: data
                    }],
                    plotOptions: {
                        bar: {
                            borderRadius: 10, // Rounded bars for a "bullet" look
                            columnWidth: '10%', // Thin bars
                            distributed: false // Colors for each bar
                        }
                    },
                    xaxis: {
                        categories: labels,
                        labels: {
                            rotate: -45, // Rotate labels for readability
                            style: {
                                colors: '#333' // Label color
                            }
                        },
                        axisBorder: {
                            show: false // Hide x-axis border
                        },
                        axisTicks: {
                            show: false // Hide x-axis ticks
                        },
                    },
                    yaxis: {
                        labels: {
                            show: false, // Hide y-axis labels
                            style: {
                                colors: '#333' // Label color
                            }
                        }
                    },
                    grid: {
                        show: false // Hide grid lines
                    },
                    dataLabels: {
                        enabled: false // Hide data labels
                    },
                    legend: {
                        show: false // Hide legend
                    }
                };

                // Create and render the new chart, storing the instance globally
                window.topAvgDailySalesChart = new ApexCharts(document.querySelector("#top_avg_daily_sales_chart"), options);
                window.topAvgDailySalesChart.render();
            }


            // top_opps_by_assign_user_chart




            let tcc = @json($top_stats);
            console.log("top start");
            console.log(tcc);
            console.log("top end");

            topContactsChart(tcc.contacts);
            topSalesByMonths(tcc.sales);
            topAverageYearlySales(tcc.sales.year_wise_sale_count);
            countryWiseCharts(tcc.countrywise);
            // top_opportunities_by_status(tcc.totaloppor, tcc.opportunities);
            // top_appointments_by_status(tcc.totaloppo, tcc.appointments);
            top_calls_by_status(tcc.totalcalls, tcc.calls);
        </script>
    @endif

@endsection
