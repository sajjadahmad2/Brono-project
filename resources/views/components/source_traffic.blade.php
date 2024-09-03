<style>
    .channel-card {
        height: 98%;
    }
</style>
<div class="col-lg-4 col-xl-4 col-xxl-4 col-xxl- mb-5 mb-xl-10">
    <!--begin::List widget 9-->
    <div class="channel-card card card-flush">
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
                <a href="#" class="btn btn-sm btn-light">Order Details</a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Scroll-->
            <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                @foreach ($finalOpportunities as $key => $opportunity)
                <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                    <!--begin::Info-->
                    <div class="d-flex flex-stack mb-3">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack">
                            <!--begin::Icon-->
                            @if (strpos(strtolower($opportunity['source']), 'facebook') !== false)
                            <img src="{{ asset('icons/facebook.png') }}" class="w-55px ms-n1 me-10" alt="">
                            @elseif(strpos(strtolower($opportunity['source']), 'instagram') !== false)
                            <img src="{{ asset('icons/instagram.png') }}" class="w-55px ms-n1 me-10" alt="">
                            @elseif($opportunity['source'] === 'Direct Traffic')
                            <img src="{{ asset('icons/direct_traffic.png') }}" class="w-55px ms-n1 me-10" alt="">
                            @else
                            <img src="{{ asset('icons/others.png') }}" class="w-55px ms-n1 me-10" alt="">
                            @endif
                            <!--end::Icon-->

                            <!--begin::Title-->
                            <a href="#" class="text-gray-800 text-4xl text-hover-primary fw-bold">
                                {{ number_format($opportunity['count']) }}
                            </a>
                            <!--end::Title-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Action-->
                        <div class="m-0">
                            <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                data-bs-toggle="modal" data-bs-target="#modal_{{ $key }}">
                                <i class="ki-duotone ki-dots-square fs-1">
                                    <span class="path1"></span><span class="path2"></span>
                                    <span class="path3"></span><span class="path4"></span>
                                </i>
                            </button>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Info-->

                    <!--begin::Customer-->
                    <div class="d-flex flex-stack">
                        <!--begin::Name-->
                        <span class="text-gray-500 text-1xl fw-bold">SALES Amount:
                            <a href="#" class="text-gray-800 text-hover-primary fw-bold">
                                € {{ number_format($opportunity['total_value'], 2) }}
                            </a>
                        </span>
                        <!--end::Name-->

                        <!--begin::Label-->
                        <span class="badge {{ $key === 0 ? 'badge-light-success' : 'badge-light-danger' }}">
                            {{ number_format($opportunity['percentage'], 2) }}%
                        </span>
                        <!--end::Label-->
                    </div>
                    <!--end::Customer-->
                </div>
                @endforeach
            </div>
            <!--end::Scroll-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::List widget 9-->
</div>


<style>
    .modal-content : {
        width: 45vw;
    }

    .table-f-display: {
        display: table-caption !important;
        height: 50% !important;
    }
</style>

@foreach ($finalOpportunities as $key => $opportunity)
<div class="modal fade" id="modal_{{ $key }}" tabindex="-1" aria-labelledby="modalLabel_{{ $key }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-black">
                <h5 class="modal-title font-semibold text-white text-lg " id="modalLabel_{{ $key }}">{{
                    $opportunity['source'] ?? 'Unknown' }}
                    Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Summary Information -->
                <div class="mb-4 border rounded bg-white p-4 shadow-sm">
                    <div class="fw-bold fs-5 text-primary mb-3">Summary</div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-gray-600">Source:</div>
                        <div class="col-sm-8 text-gray-800 font-semibold ">{{ $opportunity['source'] ?? 'Unknows' }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-gray-600">Total Count:</div>
                        <div class="col-sm-8 text-gray-800 font-semibold ">{{ number_format($opportunity['count']) }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-gray-600">Total Value:</div>
                        <div class="col-sm-8 text-gray-800 font-semibold ">€
                            {{ number_format($opportunity['total_value'], 2) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold text-gray-600">Percentage:</div>
                        <div class="col-sm-8 text-gray-800 font-semibold ">{{ number_format($opportunity['percentage'],
                            2) }}%
                        </div>
                    </div>
                </div>

                <!-- Details Table (only if available) -->
                @if (isset($opportunity['details']) && count($opportunity['details']) > 0)
                <div class="grid">
                    <div class="card card-grid min-w-full mb-4 border rounded bg-white p-4 shadow-sm">
                        <div class="card-header py-5 flex-wrap">
                            <h3 class="fw-bold fs-5 text-primary mb-3">Details</h3>
                        </div>
                        <div class="card-body">
                            <div data-datatable="true" data-datatable-page-size="5" data-datatable-state-save="true"
                                id="datatable_1">
                                <div class="overflow-y-auto">
                                    <table class="table-f-display table-auto table-border text-lg w-full"
                                        data-datatable-table="true" style="display: table-caption; height:550px">
                                        <thead>
                                            <tr class="bg-light fw-bold">
                                                <th class="w-[100px] text-center py-3 px-4">Source</th>
                                                <th class="w-[100px] text-center py-3 px-4">Count</th>
                                                <th class="w-[100px] text-center py-3 px-4">Total Value</th>
                                                <th class="w-[100px] text-center py-3 px-4">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($opportunity['details'] as $detail)
                                            <tr class="hover:bg-gray-100">
                                                <td class="px-4 py-2 border-b">{{ $detail['source'] ??
                                                    'Unknown' }}</td>
                                                <td class="px-4 py-2 border-b">{{
                                                    number_format($detail['count']) }}</td>
                                                <td class="px-4 py-2 border-b">€ {{
                                                    number_format($detail['total_value'], 2) }}</td>
                                                <td class="px-4 py-2 border-b">{{
                                                    number_format($detail['percentage'], 2) }}%</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @else
                <div class="alert alert-info text-center" role="alert">
                    No additional details available.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach