@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')

@endsection
@section('content')
    <div id="kt_app_content_container" class="app-container  container-xxl "
        data-select2-id="select2-data-kt_app_content_container">

        <!--begin::Form-->
        <form action="{{ isset($property) ? route('property.save', $property->id) : route('property.save') }}"
            id="kt_ecommerce_add_product_form"
            class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
            data-kt-redirect="/metronic8/demo1/apps/ecommerce/catalog/products.html"
            data-select2-id="select2-data-kt_ecommerce_add_product_form" method="POST" enctype="multipart/form-data">
            @csrf

            @if (isset($property))
                <input type="hidden" name="id" value="{{ $property->id }}">
            @endif


            <!--begin::Aside column-->
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10"
                data-select2-id="select2-data-160-3u1x">
                <!--begin::Thumbnail settings-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Thumbnail</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--begin::Image input placeholder-->
                        <style>
                            .image-input-placeholder {
                                background-image: url("{{ asset('assets/media/svg/files/blank-image.svg') }}");
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url('{{ asset("assets/media/svg/files/blank-image-dark.svg") }}');
                            }
                        </style>
                        <!--end::Image input placeholder-->

                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                            data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <!--end::Preview existing avatar-->

                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                                data-bs-original-title="Change avatar" data-kt-initialized="1">
                                <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                        class="path2"></span></i>
                                <!--begin::Inputs-->
                                <input type="file" name="images[]" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove">
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->

                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar"
                                data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </span>
                            <!--end::Cancel-->

                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar"
                                data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the Property thumbnail image. Only *.png, *.jpg and *.jpeg image
                            files are accepted</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Thumbnail settings-->
                <!--begin::Status-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Status / Type</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select class="form-select" name="new_build" required>
                            <option value="">Please Select</option>
                            <option value="0"
                                {{ old('new_build', $property->new_build ?? '') == '0' ? 'selected' : '' }}>New Build
                            </option>
                            <option value="1"
                                {{ old('new_build', $property->new_build ?? '') == '1' ? 'selected' : '' }}>Sale
                            </option>
                            {{-- <option value="scheduled">Scheduled</option>
                        <option value="inactive">Inactive</option> --}}
                        </select>

                        <!--end::Select2-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the property status.</div>
                        <!--end::Description-->



                        <div class="mt-10">
                            <select class="form-select" id="type" name="type" required>
                                <option value="Villa"
                                    {{ old('type', $property->type ?? '') == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="Apartment"
                                    {{ old('type', $property->type ?? '') == 'Apartment' ? 'selected' : '' }}>
                                    Apartment
                                </option>
                                <option value="Penthouse"
                                    {{ old('type', $property->type ?? '') == 'Penthouse' ? 'selected' : '' }}>
                                    Pent House
                                </option>
                                <option value="Bungalow"
                                    {{ old('type', $property->type ?? '') == 'Bungalow' ? 'selected' : '' }}>
                                    Bungalow
                                </option>

                                <option value="Town House"
                                    {{ old('type', $property->type ?? '') == 'Town House' ? 'selected' : '' }}>
                                    Town
                                    House</option>

                                <option value="Quad House" <option value="Town House"
                                    {{ old('type', $property->type ?? '') == 'Quad House' ? 'selected' : '' }}>
                                    Quad
                                    House</option>
                                <!-- Add more options as needed -->
                            </select>
                            <div class="text-muted fs-7">Set the property type.</div>
                        </div>
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status-->

                <!--begin::Category & tags-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Currency Details</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" id="currency" name="currency" required>
                                <option value="EUR"
                                    {{ old('currency', $property->currency ?? '') == 'EUR' ? 'selected' : '' }}>EUR -
                                    Euro</option>
                                <option value="USD"
                                    {{ old('currency', $property->currency ?? '') == 'USD' ? 'selected' : '' }}>USD -
                                    US Dollar</option>
                                <option value="GBP"
                                    {{ old('currency', $property->currency ?? '') == 'GBP' ? 'selected' : '' }}>GBP -
                                    British Pound</option>
                                <option value="JPY"
                                    {{ old('currency', $property->currency ?? '') == 'JPY' ? 'selected' : '' }}>JPY -
                                    Japanese Yen</option>
                                <option value="AUD"
                                    {{ old('currency', $property->currency ?? '') == 'AUD' ? 'selected' : '' }}>AUD -
                                    Australian Dollar</option>
                                <option value="CAD"
                                    {{ old('currency', $property->currency ?? '') == 'CAD' ? 'selected' : '' }}>CAD -
                                    Canadian Dollar</option>
                                <option value="CHF"
                                    {{ old('currency', $property->currency ?? '') == 'CHF' ? 'selected' : '' }}>CHF -
                                    Swiss Franc</option>
                                <option value="CNY"
                                    {{ old('currency', $property->currency ?? '') == 'CNY' ? 'selected' : '' }}>CNY -
                                    Chinese Yuan</option>
                                <option value="INR"
                                    {{ old('currency', $property->currency ?? '') == 'INR' ? 'selected' : '' }}>INR -
                                    Indian Rupee</option>
                                <option value="BRL"
                                    {{ old('currency', $property->currency ?? '') == 'BRL' ? 'selected' : '' }}>BRL -
                                    Brazilian Real</option>
                                <option value="RUB"
                                    {{ old('currency', $property->currency ?? '') == 'RUB' ? 'selected' : '' }}>RUB -
                                    Russian Ruble</option>
                                <!-- Add more currencies as needed -->
                            </select>
                        </div>

                        <!--begin::Description-->
                        <div class="text-muted fs-7 mb-7">Add property currency</div>
                        <!--end::Description-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category & tags-->
                {{-- Pending Tagify --}}
                <!--begin::Weekly sales-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Property Features</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <input id="kt_ecommerce_add_property_features" name="feature" class="form-control mb-2 tagify"
                            value="" tabindex="-1">
                        <div class="text-muted fs-7 mb-7">Hit enter to add multiple features</div>
                    </div>
                    <!--end::Card body-->
                </div>

                <!--end::Template settings-->
            </div>
            <!--end::Aside column-->

            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" data-select2-id="select2-data-142-usbz">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
                    role="tablist">
                    <!--begin:::Tab item-->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_general" aria-selected="false" role="tab"
                            tabindex="-1">General</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_advanced" aria-selected="true" role="tab">Location</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_other" aria-selected="true" role="tab">Other</a>
                    </li>
                    <!--end:::Tab item-->


                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>General</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    {{-- Pending Property Title --}}
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Property Title</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="property_title" class="form-control mb-2"
                                            placeholder="Property title" value="">
                                        <!--end::Input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">A property title is required and recommended to be SEO
                                            friendly.</div>
                                        <!--end::Description-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div>
                                        <!--begin::Label-->
                                        <label class="form-label">Description</label>
                                        <!--end::Label-->
                                        <textarea class="form-control" id="kt_docs_tinymce_basic" name="description" rows="4"
                                            placeholder="Enter property description" required>{{ old('description', $property->descriptionEn->description ?? '') }}
                                            <p>Here goes the description</p>
                                        </textarea>
                                        <div class="text-muted fs-7">Set a description to the property for better
                                            visibility.
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>

                            <!--end::General options-->
                            <!--begin::Media-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Media</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                {{-- Pending Gallery --}}
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-2">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone dz-clickable" id="kt_dropzonejs_example_1">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="ki-duotone ki-file-up text-primary fs-3x"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to
                                                        upload.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-500">Upload up to 10
                                                        files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product media gallery.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Media-->

                            <!--begin::Pricing-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Pricing</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Property Price</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="number" placeholder="Property Price" class="form-control"
                                            id="price" name="price"
                                            value="{{ old('price', $property->price ?? '') }}" required>

                                        <!--end::Input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the property price.</div>
                                        <!--end::Description-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                </div>
                                <!--end::Card header-->

                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="/metronic8/demo1/apps/ecommerce/catalog/products.html"
                                    id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                    Cancel
                                </a>
                                <!--end::Button-->

                                {{--
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    Save Changes
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button--> --}}
                            </div>
                            <!--end::Pricing-->
                        </div>
                    </div>
                    <!--end::Tab pane-->

                    <!--begin::Tab pane-->
                    <div class="tab-pane fade active show card card-flush " id="kt_ecommerce_add_product_advanced"
                        role="tab-panel" data-select2-id="select2-data-kt_ecommerce_add_product_advanced">
                        <div class="d-flex flex-column gap-7 gap-lg-10" data-select2-id="select2-data-140-grm0">


                            {{-- Strts With Step 1 --}}
                            <!--begin::Inventory-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Property Detail</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Reference</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->

                                        <input type="text" class="form-control" placeholder="Reference"
                                            id="ref" name="ref" value="{{ old('ref', $property->ref ?? '') }}"
                                            required>
                                        <!--end::Input-->

                                        {{--
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Location_Detail</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" placeholder="Location_Detail"
                                            id="location_detail" name="location_detail"
                                            value="{{ old('location_detail', $property->location_detail ?? '') }}"
                                            required>

                                        {{--
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Town</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" placeholder="Town" class="form-control" id="town"
                                            name="town" value="{{ old('town', $property->town ?? '') }}" required>
                                        {{--
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description--> --}}
                                    </div>
                                    <!--end::Input group-->

                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Province</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" placeholder="Province" class="form-control" id="province"
                                            name="province" value="{{ old('province', $property->province ?? '') }}"
                                            required>
                                        <!--end::Input-->

                                        {{--
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description--> --}}
                                    </div>
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Longitude</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" id="longitude"
                                            placeholder="Longitude" name="location[longitude]"
                                            value="{{ old('location.longitude', isset($property) ? $property->location->longitude : '') }}"
                                            required>

                                        <!--end::Input-->

                                        {{--
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description--> --}}
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Latitude</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" id="latitude" placeholder="Latitude"
                                            name="location[latitude]"
                                            value="{{ old('location.latitude', isset($property) ? $property->location->latitude : '') }}"
                                            required>


                                        <!--end::Input-->

                                        {{--
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description--> --}}
                                    </div>


                                    {{--
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Barcode</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="barcode" class="form-control mb-2"
                                        placeholder="Barcode Number" value="">
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product barcode number.</div>
                                    <!--end::Description-->
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group--> --}}


                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Inventory-->

                            <!--begin::Variations-->
                            {{-- <div class="card card-flush py-4" data-select2-id="select2-data-139-scwy">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Variations</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0" data-select2-id="select2-data-138-rqr2">
                                <!--begin::Input group-->
                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options"
                                    data-select2-id="select2-data-137-rs36">
                                    <!--begin::Label-->
                                    <label class="form-label">Add Product Variations</label>
                                    <!--end::Label-->

                                    <!--begin::Repeater-->
                                    <div id="kt_ecommerce_add_product_options"
                                        data-select2-id="select2-data-kt_ecommerce_add_product_options">
                                        <!--begin::Form group-->
                                        <div class="form-group" data-select2-id="select2-data-136-41qz">
                                            <div data-repeater-list="kt_ecommerce_add_product_options"
                                                class="d-flex flex-column gap-3"
                                                data-select2-id="select2-data-135-d23o">

                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group mt-5">
                                            <button type="button" data-repeater-create=""
                                                class="btn btn-sm btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-2"></i> Add another variation
                                            </button>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div> --}}
                            <!--end::Variations-->

                            <!--begin::Shipping-->
                            <div class="    card card-flush py-4">
                                <!--begin::Card header-->
                                {{-- <div class="card-header">
                                <div class="card-title">
                                    <h2>Shipping</h2>
                                </div>
                            </div> --}}
                                <!--end::Card header-->

                                <!--begin::Card body-->

                                <!--begin::Input group-->
                                {{-- <div class="fv-row">
                                <!--begin::Input-->
                                <div class="form-check form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input" type="checkbox"
                                        id="kt_ecommerce_add_product_shipping_checkbox" value="1">
                                    <label class="form-check-label">
                                        This is a physical product
                                    </label>
                                </div>
                                <!--end::Input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set if the product is a physical or digital item.
                                    Physical products may require shipping.</div>
                                <!--end::Description-->
                            </div> --}}
                                <!--end::Input group-->

                                <!--begin::Shipping form-->
                                {{-- <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Weight</label>
                                    <!--end::Label-->

                                    <!--begin::Editor-->
                                    <input type="text" name="weight" class="form-control mb-2"
                                        placeholder="Product weight" value="">
                                    <!--end::Editor-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Dimension</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                        <input type="number" name="width" class="form-control mb-2"
                                            placeholder="Width (w)" value="">
                                        <input type="number" name="height" class="form-control mb-2"
                                            placeholder="Height (h)" value="">
                                        <input type="number" name="length" class="form-control mb-2"
                                            placeholder="Lengtn (l)" value="">
                                    </div>
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div> --}}
                                <!--end::Shipping form-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Shipping-->
                    </div>
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade active show" id="kt_ecommerce_add_product_other" role="tab-panel"
                        data-select2-id="select2-data-kt_ecommerce_add_product_advanced">
                        <div class="d-flex flex-column gap-7 gap-lg-10" data-select2-id="select2-data-140-grm0">

                            <!--begin::Other Details 1-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Other Details</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Property URL</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="url" class="form-control" placeholder="Property URL"
                                            id="url" name="url"
                                            value="{{ old('url', $property->urlEn->url ?? '') }}"
                                            placeholder="https://example.com" required>

                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the product SKU.</div>
                            <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10  fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label mx-w-sm">Beds</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <div class="d-flex gap-3">
                                            <input type="number" class="form-control" placeholder="Beds" id="beds"
                                                name="beds" value="{{ old('beds', $property->beds ?? '') }}" required>

                                        </div>
                                        <!--begin::Label-->
                                        <label class="required form-label">Baths</label>
                                        <!--end::Label-->
                                        <div class="d-flex gap-3">
                                            <input type="number" class="form-control" id="baths"
                                                placeholder="Baths" name="baths"
                                                value="{{ old('baths', $property->baths ?? '') }}" required>

                                        </div>
                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the product quantity.</div>
                            <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label">Has Pool</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input type="checkbox" class="form-check-input" id="pool"
                                                name="pool" {{ old('pool', $property->pool ?? 0) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Yes
                                            </label>
                                        </div>
                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Allow customers to purchase products that are out of stock.
                            </div>
                            <!--end::Description--> --}}
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>

                            {{-- Surface Area Details --}}
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Surface Area Details</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Built Surface Area</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" placeholder="Built Surface Area"
                                            id="built" name="surface_area[built]"
                                            value="{{ old('surface_area.built', isset($property) ? $property->surfaceArea->built : '') }}"
                                            required>
                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the product SKU.</div>
                            <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Plot Surface Area</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" id="plot"
                                            placeholder="Plot Surface Area" name="surface_area[plot]"
                                            value="{{ old('surface_area.plot', isset($property) ? $property->surfaceArea->plot : '') }}"
                                            required>

                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the product SKU.</div>
                            <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>

                            {{-- Energy Rating Detail --}}
                            <!--end::Card header-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Energy Rating Details</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Energy Consumption</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" id="energy_consumption"
                                            placeholder="Energy Consumption" name="energy_rating[consumption]"
                                            value="{{ old('energy_rating.consumption', isset($property) ? $property->energyRating->consumption : '') }}"
                                            required>

                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the product SKU.</div>
                            <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">Energy Emission</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control" id="energy_emission"
                                            placeholder="Energy Emission" name="energy_rating[emissions]"
                                            value="{{ old('energy_rating.emission', isset($property) ? $property->energyRating->emissions : '') }}"
                                            required>
                                        <!--end::Input-->

                                        {{--
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the product SKU.</div>
                            <!--end::Description--> --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->



                                </div>
                                <!--end::Card header-->
                            </div>
                        </div>
                        <!--end::Shipping-->
                    </div>
                </div>
                <!--end::Tab pane-->




            </div>
            <!--end::Tab pane-->

    </div>
    <!--end::Tab content-->

    <div class="d-flex justify-content-end">
        <!--begin::Button-->
        <a href="/metronic8/demo1/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
            class="btn btn-light me-5">
            Cancel
        </a>
        <!--end::Button-->

        <!--begin::Button-->

        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
            {{ isset($property) ? 'Update Property' : 'Save Property' }}
        </button>
        <!--end::Button-->
    </div>
    </div>
    <!--end::Main column-->
    </form>
    <!--end::Form-->
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>

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


        //tagify
        var input1 = document.querySelector(".tagify");
        new Tagify(input1);

        //textarea editor
        var options = {
            selector: "#kt_docs_tinymce_basic",
            height: "480"
        };

        if (KTThemeMode.getMode() === "dark") {
            options["skin"] = "oxide-dark";
            options["content_css"] = "dark";
        }

        tinymce.init(options);


        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            paramName: "images", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    </script>


@endsection
