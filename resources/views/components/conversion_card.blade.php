<!--begin::Card widget 8-->
<!--begin::Card widget 8-->
<div class="card card-flush h-60 mb-xl-10" style="overflow-y: auto">
    <!--begin::Header-->
    <div class="card-header py-7">
        <!--begin::Statistics-->
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center mb-2">
                <!--begin::Title-->
                <span class="fs-2x fw-bold text-gray-800 me-2 lh-1 ls-n2">Conversion Rates</span>
                <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Description-->
            <span class="fs-6 fw-semibold text-gray-500">Conversion Calculation</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body d-flex justify-content-between flex-column pt-3">
        @if (isset($cov_stats) && is_array($cov_stats))
            @foreach ($cov_stats as $key => $cov)
                @if ($key != 'users')
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="#"
                                    class="text-gray-800 fw-bold text-hover-primary fs-6">{{ ucfirst(str_replace('_', ' ', $key)) }}</a>
                                <!--end::Title-->

                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">{{ $cov['total'] }}
                                    total</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span
                                    class="text-gray-800 fw-bold fs-4 me-3">{{ number_format($cov['conversion_rate'], 2) }}%</span>
                                <!--end::Number-->

                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <span
                                        class="badge badge-light-{{ $cov['direction'] == 'down' ? 'danger' : 'success' }} fs-base">
                                        <i
                                            class="ki-outline ki-arrow-{{ $cov['direction'] == 'down' ? 'down' : 'up' }} fs-5 text-{{ $cov['direction'] == 'down' ? 'danger' : 'success' }} ms-n1"></i>
                                        {{ number_format($cov['direction_value'], 2) }}%
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
<!--end::Card widget 8-->
