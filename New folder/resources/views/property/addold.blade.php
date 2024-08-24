@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')

@endsection
@section('content')


    <div class="container">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="fw-bold text-dark">Add New Property</h2>
                <p class="text-muted">Fill in the details to list a new property.</p>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Property Form -->
        <form action="{{ isset($property) ? route('property.save', $property->id) : route('property.save') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($property))
                <input type="hidden" name="id" value="{{ $property->id }}">
            @endif

            <div class="row">
                <!-- Property Info -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Property Information</h3>
                        </div>
                        <div class="card-body">
                            <!-- Property Reference -->
                            <div class="mb-3">
                                <label for="ref" class="form-label">Reference</label>
                                <input type="text" class="form-control" id="ref" name="ref"
                                    value="{{ old('ref', $property->ref ?? '') }}" required>
                            </div>
                            <!-- Property Type -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="Villa"
                                        {{ old('type', $property->type ?? '') == 'Villa' ? 'selected' : '' }}>Villa</option>
                                    <option value="Apartment"
                                        {{ old('type', $property->type ?? '') == 'Apartment' ? 'selected' : '' }}>Apartment
                                    </option>
                                    <option value="Penthouse"
                                        {{ old('type', $property->type ?? '') == 'Penthouse' ? 'selected' : '' }}>Pent House
                                    </option>
                                    <option value="Bungalow"
                                        {{ old('type', $property->type ?? '') == 'Bungalow' ? 'selected' : '' }}>Bungalow
                                    </option>

                                    <option value="Town House"
                                        {{ old('type', $property->type ?? '') == 'Town House' ? 'selected' : '' }}>Town
                                        House</option>

                                    <option value="Quad House" <option value="Town House"
                                        {{ old('type', $property->type ?? '') == 'Quad House' ? 'selected' : '' }}>Quad
                                        House</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <!-- location_detail -->
                            <div class="mb-3">
                                <label for="location_detail" class="form-label">Location Detail</label>
                                <input type="text" class="form-control" id="location_detail" name="location_detail"
                                    value="{{ old('location_detail', $property->location_detail ?? '') }}" required>
                            </div>
                            <!-- Town -->
                            <div class="mb-3">
                                <label for="town" class="form-label">Town</label>
                                <input type="text" class="form-control" id="town" name="town"
                                    value="{{ old('town', $property->town ?? '') }}" required>
                            </div>
                            <!-- Province -->
                            <div class="mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="{{ old('province', $property->province ?? '') }}" required>
                            </div>
                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"
                                    placeholder="Enter property description" required>{{ old('description', $property->descriptionEn->description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Property Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ old('price', $property->price ?? '') }}" required>
                            </div>
                            <!-- Currency -->
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
                            <!-- URL -->
                            <div class="mb-3">
                                <label for="url" class="form-label">Property URL</label>
                                <input type="url" class="form-control" id="url" name="url"
                                    value="{{ old('url', $property->urlEn->url ?? '') }}"
                                    placeholder="https://example.com" required>
                            </div>

                            <!-- Beds -->
                            <div class="mb-3">
                                <label for="beds" class="form-label">Beds</label>
                                <input type="number" class="form-control" id="beds" name="beds"
                                    value="{{ old('beds', $property->beds ?? '') }}" required>
                            </div>
                            <!-- Baths -->
                            <div class="mb-3">
                                <label for="baths" class="form-label">Baths</label>
                                <input type="number" class="form-control" id="baths" name="baths"
                                    value="{{ old('baths', $property->baths ?? '') }}" required>
                            </div>
                            <!-- Pool -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="pool" name="pool"
                                    {{ old('pool', $property->pool ?? 0) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pool">Has Pool</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Location & Images -->
            <div class="row mt-5">
                <!-- Location Details -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Location Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Latitude -->
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="location[latitude]"
                                    value="{{ old('location.latitude', isset($property) ? $property->location->latitude : '') }}"
                                    required>
                            </div>
                            <!-- Longitude -->
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="location[longitude]"
                                    value="{{ old('location.longitude', isset($property) ? $property->location->longitude : '') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Energy Rating Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Energy Consumption -->
                            <div class="mb-3">
                                <label for="energy_consumption" class="form-label">Energy Consumption</label>
                                <input type="text" class="form-control" id="energy_consumption"
                                    name="energy_rating[consumption]"
                                    value="{{ old('energy_rating.consumption', isset($property) ? $property->energyRating->consumption : '') }}"
                                    required>
                            </div>
                            <!-- Energy Rating -->
                            <div class="mb-3">
                                <label for="energy_emission" class="form-label">Energy Emission</label>
                                <input type="text" class="form-control" id="energy_emission"
                                    name="energy_rating[emissions]"
                                    value="{{ old('energy_rating.emission', isset($property) ? $property->energyRating->emissions : '') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Surface Area Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Built Surface Area -->
                            <div class="mb-3">
                                <label for="built" class="form-label">Built Surface Area</label>
                                <input type="text" class="form-control" id="built" name="surface_area[built]"
                                    value="{{ old('surface_area.built', isset($property) ? $property->surfaceArea->built : '') }}"
                                    required>
                            </div>
                            <!-- Plot Surface Area -->
                            <div class="mb-3">
                                <label for="plot" class="form-label">Plot Surface Area</label>
                                <input type="text" class="form-control" id="plot" name="surface_area[plot]"
                                    value="{{ old('surface_area.plot', isset($property) ? $property->surfaceArea->plot : '') }}"required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Features -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Property Features</h3>
                        </div>
                        <div class="card-body features">

                            @forelse(old('features',isset($property) ?  $property->features : []) as $index=>$feature)
                                <div class="form-group">
                                    <div data-repeater-list="data">
                                        <div data-repeater-item>
                                            <div class="fv-row form-group row mb-5">
                                                <div class="col-md-3">
                                                    <label class="form-label">Features</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0"
                                                        name="data[{{ $index }}][feature]"
                                                        value="{{ $feature->feature }}" placeholder="Enter Feature" />
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete
                                                        class="btn btn-sm btn-flex flex-center btn-light-danger mt-3 mt-md-9">
                                                        <i class="ki-duotone ki-trash fs-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="form-group">
                                    <div data-repeater-list="data">
                                        <div data-repeater-item>
                                            <div class="fv-row form-group row mb-5">
                                                <div class="col-md-3">
                                                    <label class="form-label">Features</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0"
                                                        name="feature" placeholder="Enter Feature" />
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete
                                                        class="btn btn-sm btn-flex flex-center btn-light-danger mt-3 mt-md-9">
                                                        <i class="ki-duotone ki-trash fs-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                            <!--begin::Form group-->
                            <div class="form-group">
                                <a href="javascript:;" data-repeater-create
                                    class="btn btn-flex flex-center btn-light-primary">
                                    <i class="ki-duotone ki-plus fs-3"></i> Add
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Images Upload -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Images Upload</h3>
                        </div>
                        <div class="card-body">
                            <!-- Images -->
                            <div class="mb-3">
                                <label for="images" class="form-label">Upload Images</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                                <small class="form-text text-muted">You can select multiple images to upload.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($property) ? 'Update Property' : 'Save Property' }}
                    </button>
                </div>
            </div>
        </form>

    </div>




@endsection

@section('js')
    <!-- Include jQuery -->


    <script>
        // Define card body element instead of form
        const cardBody = document.querySelector(".features");

        // Init form validation rules. For more info check the FormValidation plugin's official documentation: https://formvalidation.io/
        var validator = FormValidation.formValidation(
            cardBody, { // Use cardBody instead of form
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    }),
                    excluded: new FormValidation.plugins.Excluded({
                        excluded: function(field, ele, eles) {
                            if (cardBody.querySelector('[name="' + field + '"]') === null) {
                                return true;
                            }
                        },
                    }),
                }
            }
        );

        const addFields = function(index) {
            const namePrefix = "data[" + index + "]";

            // Add validators
            validator.addField(namePrefix + "[feature]", {
                validators: {
                    notEmpty: {
                        message: "Text input is required"
                    }
                }
            });
        };

        const removeFields = function(index) {
            const namePrefix = "data[" + index + "]";
            validator.removeField(namePrefix + "[feature]"); // Corrected from addField to removeField
        }

        // Use the cardBody as the root for the repeater
        $(cardBody).repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();

                const index = $(this).closest("[data-repeater-item]").index();

                addFields(index);
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
                const index = $(this).closest("[data-repeater-item]").index();
                removeFields(index);
            }
        });

        // Initial fields
        addFields(0);
    </script>

@endsection
