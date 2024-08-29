@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row g-5 g-xxl-10">
        <!--begin::Col-->
        <div class="col-xxl-4 mb-xxl-10">
            <div class="container mt-5">
                <h2>Upload JSON File</h2>
                <form id="uploadForm" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="file" id="jsonFile" name="jsonFile" class="form-control" accept=".json" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
                <div id="progress" class="mt-3"></div>
            </div>
            <!--begin::Card Widget 22-->
            <div class="card card-reset mb-5 mb-xl-10">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <!--begin::Row-->
                    <div class="row g-5 g-lg-9">
                        <!--begin::Col-->
                        @role('admin')
                        <div class="col-6">
                            <!--begin::Card-->
                            <div class="card card-shadow">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <!--begin::Items-->
                                    <a href="#" class="btn btn-active-color-primary px-7 py-6 text-start w-100">
                                        <!--begin::Icon-->
                                        <h2 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Companies</h2>
                                        <!--begin::Desc-->
                                        <div class="fw-bold fs-5 pt-4">
                                            {!! totalCompanies() !!}</div>
                                        <!--end::Desc-->
                                    </a>
                                    <!--end::Items-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        @endrole
                        <!--end::Col-->
                        <!--begin::Col-->

                        <div class="col-6">
                            <!--begin::Card-->
                            <div class="card card-shadow">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <!--begin::Items-->
                                    <a href="#" class="btn btn-active-color-primary px-7 py-6 text-start w-100">
                                        <h2 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Active Companies</h2>
                                        <!--begin::Desc-->
                                        <div class="fw-bold fs-5 pt-4">
                                            {!! totalStatusUser() !!}
                                        </div>
                                        <!--end::Desc-->
                                    </a>
                                    <!--end::Items-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        @role('admin')
                        <div class="col-6">
                            <!--begin::Card-->
                            <div class="card card-shadow">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <!--begin::Items-->
                                    <a href="#" class="btn btn-active-color-primary px-7 py-6 text-start w-100">
                                        <h2 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Inactive Companies</h2>
                                        <!--begin::Desc-->
                                        <div class="fw-bold fs-5 pt-4">
                                            {!! totalStatusUser(false) !!}
                                        </div>
                                        <!--end::Desc-->
                                    </a>
                                    <!--end::Items-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        @endrole
                        <!--end::Col-->
                        <!--begin::Col-->
                        @role('admin')
                        <div class="col-6">
                            <!--begin::Card-->
                            <div class="card card-shadow">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <!--begin::Items-->
                                    <a href="#" class="btn btn-active-color-primary px-7 py-6 text-start w-100">
                                        <h2 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Roles</h2>
                                        <!--begin::Desc-->
                                        <div class="fw-bold fs-5 pt-4">
                                            {!! totalRoles() !!}
                                        </div>
                                        <!--end::Desc-->
                                    </a>
                                    <!--end::Items-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        @endrole

                        <!--begin::Col-->
                        @role('admin')
                        <div class="col-6">
                            <!--begin::Card-->
                            <div class="card card-shadow">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <!--begin::Items-->
                                    <a href="#" class="btn btn-active-color-primary px-7 py-6 text-start w-100">
                                        <h2 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Permissions</h2>
                                        <!--begin::Desc-->
                                        <div class="fw-bold fs-5 pt-4">
                                            {!! totalPermissions() !!}
                                        </div>
                                        <!--end::Desc-->
                                    </a>
                                    <!--end::Items-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        @endrole
                        <!--end::Col-->

                        <!--end::Col-->

                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card Widget 22-->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xxl-8 mb-5 mb-xl-10">
            <!--begin::Engage widget 14-->
            <div class="card border-0 mb-5 mb-xl-11" data-bs-theme="light" style="background-color: #844AFF">
                <!--begin::Body-->
                <div class="card-body py-0">
                    <!--begin::Row-->
                    <div class="row align-items-center lh-1 h-100">
                        <!--begin::Col-->
                        <div class="col-7 ps-xl-10 pe-5">
                            <!--begin::Title-->
                            <div class="fs-2qx fw-bold text-white mb-6">
                                Welcome {{ Auth::user()->first_name }}!
                            </div>
                            <!--end::Title-->

                            <!--begin::Action-->
                            @can('manage designer')
                                <div class="d-flex d-grid gap-2">
                                    <a href="{{ route('style.dashboard') }}" class="btn btn-success me-lg-2" >
                                        Design your dashboard
                                    </a>
                                    <a href="{{ request()->fullUrl().'/dashboard_css.js' }}" class="btn btn-warning me-lg-2 copy-script" >
                                        Copy the designer script
                                    </a>

                                </div>

                            @endcan
                            <!--end::Action-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-5 pt-5 pt-lg-15">
                            <!--begin::Illustration-->
                            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end bgi-position-y-bottom h-325px"
                                style="background-image:url("{{ asset('assets/media/svg/illustrations/easy/8.svg') }}")>
                            </div>
                            <!--end::Illustration-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 14-->


            @can('view user')
            <!--begin::Table widget 17-->
            <div class="card card-flush border-0 ">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fs-3 fw-bold text-gray-800">Recent Users</span>
                        <!--end::Title-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3 w-150px text-start">First Name</th>
                                    <th class="p-0 pb-3 min-w-100px text-start">Last Name</th>
                                    <th class="p-0 pb-3 min-w-100px text-center">Email</th>
                                    <th class="p-0 pb-3 w-250px text-start"> Is Active </th>
                                    <th class="p-0 pb-3 w-50px text-end">Design Enable?</th>
                                    <th class="p-0 pb-3 w-50px text-end">Action</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ logo('company_main_logo',$user->id) }}" class="" alt="Photo" />
                                                </div>
                                                <div class="d-flex justify-content-start text-left flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $user->first_name }}</a>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $user->last_name }}</a>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $user->email }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-dark fw-bolder d-block fs-6">{{ $user->status == 0 ? 'In Active' : 'Active' }}</span>
                                        </td>

                                        <td class="text-end">
                                            <span
                                                class="text-dark fw-bolder d-block fs-6">{{ $user->enable_design == 0 ? 'Disabled' : 'Enabled' }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotone/General/Settings-1.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2v-6zm0 8h2v2h-2v-2z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed border-gray-200 mb-n4"></div>
                    <!--end::Separator-->

                </div>
                <!--end: Card Body-->
            </div>
            @endcan
            <!--end::Table widget 17-->
        </div>
        <!--end::Col-->
    </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/pages/widgets.js') }}"></script>
    <script>
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
        });

    </script>
    <script>
        $(document).ready(function () {

            $('body').on('submit','#uploadForm', function (e) {
                e.preventDefault();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log(csrfToken);
                const fileInput = $('#jsonFile')[0].files[0];

                if (fileInput) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const jsonData = JSON.parse(reader.result);

                        uploadChunks(jsonData);
                    };
                    reader.readAsText(fileInput);
                }
            });

            function uploadChunks(data, csrfToken,chunkSize = 1000) {
                data=data.leadsData;
                const totalChunks = Math.ceil(data.length / chunkSize);
                let currentChunk = 0;
                function sendChunk() {
                    if (currentChunk < totalChunks) {
                        const start = currentChunk * chunkSize;
                        const end = Math.min(start + chunkSize, data.length);
                        const chunk = data.slice(start, end);
                        console.log(chunk);
                        $.ajax({
                            url: "{{route('uploadChunks')}}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                chunk: JSON.stringify(chunk),
                                chunkIndex: currentChunk,
                                totalChunks: totalChunks
                            },
                            success: function () {
                                currentChunk++;
                                $('#progress').text(`Uploading chunk ${currentChunk} of ${totalChunks}`);
                                sendChunk();
                            },
                            error: function () {
                                alert('Failed to upload chunk');
                            }
                        });
                    } else {
                        $('#progress').text('Upload complete');
                    }
                }
                sendChunk();
            }
        });
    </script>

@endsection
