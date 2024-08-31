    {{-- main stats --}}

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


    <!--end::Col-->
    <div class="main-div">
        <div class="row gx-5 gx-xl-10 mt-xl-10">
            <!--begin::Col-->
            <div class="col-lg-8 col-xl-8 col-xxl-8  mb-xl-0">
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
                    <div class="card-body d-flex justify-content-between flex-column pb-20 px-0">
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
                        <div id="top_sales_chart" class="min-h-auto ps-4 pe-6"
                            style="height: 300px; min-height: 315px;">

                        </div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Col-->

@include('components.source_traffic',get_defined_vars())
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
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_daterangepicker_4").val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_daterangepicker_4").daterangepicker({
            startDate: start,
            endDate: end,
            showDropdowns: true, // Enable month and year dropdowns
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            },
            locale: {
                format: "MMMM D, YYYY"
            }
        }, cb);

        cb(start, end);
    </script>

