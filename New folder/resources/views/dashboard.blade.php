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
    </style>
@endsection
@section('content')


    {{-- main stats --}}
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-4 col-lg-6 col-xl-6 col-xxl-4 mb-10">

            <!--begin::Card widget 4-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">#</span>
                            <!--end::Currency-->

                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2 top_total_contact">0</span>
                            <!--end::Amount-->
                        </div>
                        <!--end::Info-->

                        <!--begin::Subtitle-->
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Contacts</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->

                <!--begin::Card body-->
                <div id="top_contacts_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11">

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->

            <!--begin::Card widget 4-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">#</span>
                            <!--end::Currency-->

                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2 top_total_opportunity">0</span>
                            <!--end::Amount-->
                        </div>
                        <!--end::Info-->

                        <!--begin::Subtitle-->
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Opportunities</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->

                <!--begin::Card body-->
                <div id="top_opportunities_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70"
                    data-kt-line="11">

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->

        </div>
        <!--end::Col-->

        <div class="col-md-4 col-lg-6 col-xl-6 col-xxl-4 mb-10">

            <!--begin::Card widget 4-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">#</span>
                            <!--end::Currency-->

                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2 top_total_oppointments">69,700</span>
                            <!--end::Amount-->

                            <!--begin::Badge-->

                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->

                        <!--begin::Subtitle-->
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Appointments</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->

                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                    <!--begin::Chart-->
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="top_total_appointments" style="min-width: 70px; min-height: 70px" data-kt-size="70"
                            data-kt-line="11">

                        </div>
                    </div>
                    <!--end::Chart-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->

            <!--begin::Card widget 5-->
            <div class="card card-flush h-md-50 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2 top_total_calls">1,836</span>
                            <!--end::Amount-->

                        </div>
                        <!--end::Info-->

                        <!--begin::Subtitle-->
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Calls</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                    <!--begin::Chart-->
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="top_total_calls" style="min-width: 70px; min-height: 70px" data-kt-size="70"
                            data-kt-line="11">

                        </div>
                    </div>
                    <!--end::Chart-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 5-->

        </div>

        <!--begin::Col-->
        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-5 mb-xl-10">
            <!--begin::Card widget 7-->
            <div class="card card-flush h-md-70 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <span
                            class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ isset($cov_stats) && is_array($cov_stats) && array_key_exists('users', $cov_stats) ? $cov_stats['users'] : 345 }}
                        </span>
                        <!--end::Amount-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Assigned Users</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column justify-content-end pe-0">
                    <!--begin::Title-->
                    <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Today’s Heroes</span>
                    <!--end::Title-->
                    <!--begin::Users group-->
                    <div class="symbol-group symbol-hover flex-nowrap"style="margin-left: 0" ;>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                            <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                            <img alt="Pic" src="{{ image('avatars/300-11.jpg') }}" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                            <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                            <img alt="Pic" src="{{ image('avatars/300-2.jpg') }}" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                            <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                            <img alt="Pic" src="{{ image('avatars/300-12.jpg') }}" />
                        </div>
                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_view_users">
                            <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                        </a>
                    </div>
                    <!--end::Users group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 7-->
            <div class="card card-flush h-xl-70">
                <!--begin::Header-->
                <div class="card-header py-7">

                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">5,037</span>
                            <!--end::Title-->

                            <!--begin::Label-->
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>
                                2.2%
                            </span>
                            <!--end::Label-->

                        </div>
                        <!--end::Heading-->

                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Conversion Rates</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar d-none">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                            data-kt-menu-overflow="true">
                            <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                            data-kt-menu="true" style="">
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


                        <!--begin::Menu 2-->

                        <!--end::Menu 2-->

                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->

                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
                    @if (isset($cov_stats) && is_array($cov_stats))
                        @foreach ($cov_stats as $key => $cov)
                            @if ($key != 'users')
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Flag-->
                                    <img src="/metronic8/demo30/assets/media/svg/brand-logos/slack-icon.svg"
                                        class="me-4 w-30px" style="border-radius: 4px" alt="">
                                    <!--end::Flag-->

                                    <!--begin::Section-->
                                    <div
                                        class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                                        <!--begin::Content-->
                                        <div class="me-5">
                                            <!--begin::Title-->
                                            <a href="#"
                                                class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $key }}</a>
                                            <!--end::Title-->

                                            <!--begin::Desc-->
                                            <span
                                                class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">{{ array_key_exists('Message', $cov) ? $cov['Message'] : 'Message' }}</span>
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Content-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span
                                                class="text-gray-800 fw-bold fs-4 me-3">{{ array_key_exists('Total', $cov) ? $cov['Total'] : 0 }}</span>

                                            <!--end::Number-->

                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <i class="ki-outline ki-arrow- {{$cov['Percent']< 50 ? 'down' : 'up'}} fs-5 text-{{$cov['Percent']< 50 ? 'danger' : 'success'}} ms-n1"></i>
                                                    {{ array_key_exists('Percent', $cov) ? $cov['Percent'] : 0 }}%
                                                </span>
                                                <!--end::Label-->

                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Section-->
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
        </div>
        <!--end::Col-->
        <div class="row gx-5 gx-xl-10 mt-xl-10">
            <!--begin::Col-->
            <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
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
                                        class="path2"></span><span class="path3"></span><span
                                        class="path4"></span></i>
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
                                <span class="fs-4 fw-semibold text-gray-500 me-1">$</span>
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
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-6.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Emma
                                            Smith
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Art Director</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">smith@kpmg.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$23,000</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Melody
                                            Macy
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Marketing
                                                Analytic</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">melody@altbox.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$50,500</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-1.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Max
                                            Smith
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Software
                                                Enginer</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">max@kt.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$75,900</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-5.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Sean
                                            Bean
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Web Developer</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">sean@dellito.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$10,500</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-25.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Brian
                                            Cox
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">UI/UX Designer</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">brian@exchange.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$20,000</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-warning text-warning fw-semibold">C</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Mikaela
                                            Collins
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Head Of
                                                Marketing</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">mik@pex.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$9,300</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-9.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Francis
                                            Mitcham
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Software
                                                Arcitect</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">f.mit@kpmg.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$15,000</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-danger text-danger fw-semibold">O</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Olivia
                                            Wild
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">System Admin</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">olivia@corpmail.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$23,000</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-primary text-primary fw-semibold">N</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Neil
                                            Owen
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Account
                                                Manager</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">owen.neil@gmail.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$45,800</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-23.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Dan
                                            Wilson
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Web Desinger</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">dam@consilting.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$90,500</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-danger text-danger fw-semibold">E</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Emma
                                            Bold
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Corporate
                                                Finance</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">emma@intenso.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$5,000</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{ image('avatars/300-12.jpg') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Ana
                                            Crown
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Customer
                                                Relationship</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">ana.cf@limtel.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$70,000</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">Robert
                                            Doe
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Marketing
                                                Executive</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">robert@benko.com</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">$45,500</div>
                                        <div class="fs-7 text-muted">Sales</div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
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


    <div class="row gx-5 gx-xl-10 mb-xl-10">

        {{-- Contacts filters row --}}
        <div class="col-xxl-12 mb-5 mb-xl-12">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fs-2hx fw-bolder mb-0"> Filters</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <!--begin::Col for user dropdown-->
                            <div class="col-md-6 mb-3" id="user-filter">
                                <label for="user-select" class="form-label">User</label>
                                <select id="user-select" class="form-select">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col for tags dropdown-->
                            <div class="col-md-3 mb-3" id="tags-filter" hidden>
                                <label for="tags-select" class="form-label">Tags</label>
                                <select id="tags-select" class="form-select">
                                    <option value="">Select Tag</option>

                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col for date range picker-->
                            <div class="col-md-6 mb-3" id="date-range-filter">
                                <label for="date-range-picker" class="form-label">Date Range</label>
                                <input type="text" id="date-range-picker" class="form-control date-range-picker"
                                    placeholder="Select date range" />
                            </div>
                            <!--end::Col-->

                            <!--begin::More Filters button-->
                            <div class="col-md-12 text-end mb-3">
                                <button class="btn btn-secondary" id="filter-results">
                                    <i class="fas fa-filter"></i>Filter Contacts Results
                                </button>
                            </div>
                            <!--end::More Filters button-->
                        </div>
                        <!--end::Row-->

                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

        {{-- Contacts Charts row --}}
        <div class="row  gx-xl-12 mb-xl-12 contacts_charts_container">

            <div class="row">
                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!--begin::Chart widget 28-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_contacts"
                                        id="total_contacts">0</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Total Contacts</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button
                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">
                                    <i class="fas fa-ellipsis-h fs-1 text-gray-500 me-n1"></i>
                                </button>
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Chart widget 28-->
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!--begin::Chart widget 28-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_contacts"
                                        id="total_tags">0</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Contacts By Assigned User</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar" hidden>
                                <!--begin::Menu-->
                                <button
                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">
                                    <i class="fas fa-ellipsis-h fs-1 text-gray-500 me-n1"></i>
                                </button>
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Chart widget 28-->
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!--begin::Chart widget 28-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_contacts">0</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Contacts By Tags</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button
                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">
                                    <i class="fas fa-ellipsis-h fs-1 text-gray-500 me-n1"></i>
                                </button>
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Chart widget 28-->
                </div>
            </div>
            <div class="row  gx-xl-12 mb-xl-12 opportunities_charts_container">
                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Total Opportunities -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 "
                                        id="total_opportunities">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Total Opportunities</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="daywise_count_chart" class="h-300px w-100 min-h-auto" style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Total Opportunities -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 "
                                        id="total_opportunities_conversion">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Total Conversions</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="lead_to_sale_count_chart" class="h-300px w-100 min-h-auto"
                                style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Pipelines Wise -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="pipelines_wise">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Pipelines Wise Opportunities</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="pipelines_wise_chart" class=" w-100 min-h-auto" style="min-height: 315px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Opportunities by Status -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="opportunities_by_status">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Opportunities by Status</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="opportunities_by_status_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Monetary Value Distribution -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="monetary_value_distribution">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Monetary Value Distribution</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="monetary_value_distribution_chart" class="w-100 min-h-auto"
                                style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Opportunities Assigned Per User -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="opportunities_assigned_per_user">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Opportunities Assigned Per User</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="opportunities_assigned_per_user_chart" class=" w-100 min-h-auto"
                                style="min-height: 315px;"></div>
                        </div>
                    </div>
                </div>


                {{-- Appointments Charts --}}
                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Appointments by Source -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="total_appointments">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Total Appointments </span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="appointment_by_daywise" class=" w-100 min-h-auto" style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Appointments by Source -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="appointments_by_source">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Appointments By Source</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="appointments_by_source_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Appointments by Status -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="appointments_by_status">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Appointments By Status</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="appointments_by_status_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Appointments Assigned Per User -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="appointments_assigned_per_user">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Appointments Assigned Per User</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="appointments_assigned_per_user_chart" class=" w-100 min-h-auto"
                                style="min-height: 315px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Appointments Assigned Per User -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                                        id="appointments_assigned_per_user">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500"> Appointments Calendar Wise </span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="appointments_calendar_wise_chart" class=" w-100 min-h-auto"
                                style="min-height: 315px;">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- calls chart --}}
                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!-- Calls by Source -->
                    <div class="card card-flush h-xl-100">
                        <div class="card-header py-7">
                            <div class="m-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 " id="total_calls">0</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Total Calls </span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                            <div id="calls_by_daywise" class=" w-100 min-h-auto" style="min-height: 315px;"></div>
                        </div>
                    </div>
                </div>






            </div>
        </div>

        {{-- Opportunities Charts row --}}

    </div>

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
            document.getElementById('filter-results').addEventListener('click', function() {
                const user = document.getElementById('user-select').value;
                const tag = document.getElementById('tags-select').value;
                const dateRange = document.getElementById('date-range-picker').value;

                //ajax call to filter contacts
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
                            let contactDiv = document.querySelector('.contacts_charts_container');
                            contactDiv.innerHTML = response.html;
                            allChartsRender(response);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {
                        filterLoader(false);
                    }
                });
            });


            //empty the date range picker on load
            $(document).ready(function() {
                $('#date-range-picker').val('');
                //click on filter results button
                $('#filter-results').click();

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
            function totalContacts(total_contacts) {
                $('.total_contacts').text(total_contacts);
            }

            function countryWiseCharts(countryWiseContacts) {

                am5.ready(function() {

                    console.log(countryWiseContacts);

                    // Data for leads by country
                    var leadData = countryWiseContacts;

                    // Create root and chart
                    var root = am5.Root.new("group_by_countries");

                    // Set themes
                    root.setThemes([am5themes_Animated.new(root)]);

                    // Create chart
                    var chart = root.container.children.push(am5map.MapChart.new(root, {
                        homeZoomLevel: 0.5,
                        homeGeoPoint: {
                            longitude: 10,
                            latitude: 52
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
                        strokeWidth: 0.5,
                        label: 50
                    });

                    // Define color based on leads
                    worldSeries.mapPolygons.template.adapters.add("fill", function(fill, target) {
                        var dataItem = target.dataItem.dataContext;
                        if (dataItem.leads > 0) {
                            return am5.color(0x00CC00); // Green color for countries with leads
                        } else {
                            return am5.color(0xCCCCCC); // Grey color for countries with 0 or no leads
                        }
                    });

                    // Add data to map
                    worldSeries.data.setAll(leadData);

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
                document.querySelector('.top_total_contact').innerHTML = topStats.total_contacts;
                var options = {
                    chart: {
                        type: 'donut',
                        height: 180
                    },
                    series: [topStats.total_contacts, topStats.agencies, topStats.leads, topStats.recruitment, topStats
                        .no_tags, topStats.sollicitants
                    ],
                    labels: ['Total Contacts', 'Agencies', 'Leads', 'Recruitment', 'No Tags', 'Sollicitants'],
                    responsive: [{
                        breakpoint: 180,
                        options: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                }

                var chart = new ApexCharts(document.querySelector("#top_contacts_chart"), options);
                chart.render();
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

                document.querySelector('.top_total_sales').innerText = saleByMonth.total;

                var dates = Object.keys(saleByMonth.won_opportunities);
                var counts = Object.values(saleByMonth.won_opportunities);

                var options = {
                    chart: {
                        type: 'line',
                        height: 350,
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
                        name: 'Total Sales',
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
                            text: 'Number of Sales'
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

                var chart = new ApexCharts(document.querySelector("#top_sales_chart"), options);
                chart.render();
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




            let tcc = @json($top_stats);
            console.log("top start");
            console.log(tcc);
            console.log("top end");

            topContactsChart(tcc.contacts);
            topSalesByMonths(tcc.sales);
            top_opportunities_by_status(tcc.totaloppor, tcc.opportunities);
            top_appointments_by_status(tcc.totaloppo, tcc.appointments);
            top_calls_by_status(tcc.totalcalls, tcc.calls);
        </script>
    @endif

@endsection