@extends('layouts.app')

@section('title', 'Properties')
@section('css')

@endsection
@section('content')

    <style>
        .select2-container--bootstrap5 .select2-dropdown {
            display: block;
            width: 100%;
            padding: .775rem 1rem;
            font-size: 1.1rem;
            font-weight: 500;
            line-height: 1.5;
            color: #484b5a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e4e6ef;
            appearance: none;
            border-radius: .475rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .075);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .flex-column-fluid {
            flex: 0 0 auto;
        }

        .select2-results {
            background-color: #ffffff;
        }

        .select2-results__option:hover {
            background-color: #cbcccf;
        }

        .select2-results__option:hover {
            background-color: #cbcccf !important
        }

        select2-results__option select2-results__option--selectable select2-results__option--highlighted {
            background-color: black;
        }

        .prop {
            margin-bottom: -27%;
        }
        .shoaib{
            display: flex;
        }
    </style>
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Properties</li>
                    </ol>
                </div>
                <h4 class="page-title">Properties</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row p-4">
        <div class="flex items-center justify-between col-md-6 col-sm-12">
            <div class="relative flex items-start justify-end mb-8">
                <!-- Dropdown Container -->
                    <div class="relative inline-block min-w-[150px]">
                        <select id="perpage" name="perpage"
                            class="form-select block w-full py-2 pl-3 pr-10 border border-gray-300 bg-white text-gray-900  shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            <option value="all" {{ in_array('all', (array) $selectedPerpage) ? 'selected' : '' }}>Default
                            </option>
                            <option value="50" {{ in_array('50', (array) $selectedPerpage) ? 'selected' : '' }}>50
                            </option>
                            <option value="100" {{ in_array('100', (array) $selectedPerpage) ? 'selected' : '' }}>100
                            </option>
                            <option value="500" {{ in_array('500', (array) $selectedPerpage) ? 'selected' : '' }}>500
                            </option>
                        </select>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Properties Count Container -->
                    <div class="prop absolute bottom-0 left-0 mt-4 flex flex-col items-start  ">
                        <p class="text-gray-600 text-sm">Properties Count</p>
                        <div class="bg-white border border-gray-300 rounded-lg px-2 py-1">
                            <h1 class="text-1xl font-semibold text-gray-900">
                                {{ isset($propertiesCount) ? $propertiesCount : 0 }}</h1>
                        </div>
                    </div>

            </div>
        </div>

        <div class="col-md-6 col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_3">
                Import XML
            </button>
            <a href="{{ route('property.add') }}" class="btn btn-primary"><i></i>Add New</a>
        </div>
    </div>

    <div class="row p-4">
        <!-- Main Div to Click (Filter) -->
        <div class="bg-white rounded-lg shadow-md cursor-pointer flex items-center p-4" id="filter-button">
            <i class="fas fa-filter text-blue-500 text-2xl mr-3" id="filter-icon"></i>
            <span class="text-xl font-semibold">Filter</span>
        </div>

        <!-- Filter Form Card (Initially Hidden) -->
        <div class="bg-white rounded-lg shadow-md mt-6 p-6 transition-height transition-opacity overflow-hidden max-h-0 opacity-0"
            id="filter-card">
            <h3 class="text-2xl font-bold mb-4">Search Properties</h3>
            <form id='filterform'>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Enter Your Keyword -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="keyword">Enter Your
                            Keyword</label>
                        <input id="keyword" name="keyword"
                            class="form-input mt-1 p-3.5 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Search..." type="text" value="{{ old('keyword', $selectedKeyword) }}" />
                    </div>

                    <!-- Select Location -->
                    <div class="mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-2">Select Location</label>
                        <select id="location" name="location[]"
                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            data-control="select2" data-placeholder="Select an option" data-allow-clear="true"
                            multiple="multiple">
                            @foreach ($location_detail as $value)
                                <option value="{{ $value }}"
                                    {{ in_array($value, (array) $selectedLocations) ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Property Type -->
                    <div class="mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                        <select id="property-type" name="propertyType[]"
                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            data-control="select2" data-placeholder="Select an option" data-allow-clear="true"
                            multiple="multiple">
                            @foreach ($types as $value)
                                <option value="{{ $value }}"
                                    {{ in_array($value, (array) $selectedPropertyTypes) ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Category -->
                    <div class="mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-2">Select Category</label>
                        <select id="category" name="category[]"
                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            data-control="select2" data-placeholder="Select an option" data-allow-clear="true"
                            multiple="multiple">
                            <option value="all" {{ in_array('all', (array) $selectedCategories) ? 'selected' : '' }}>All
                                Categories</option>
                            <option value="1" {{ in_array('1', (array) $selectedCategories) ? 'selected' : '' }}>New
                                Build</option>
                            <option value="0" {{ in_array('0', (array) $selectedCategories) ? 'selected' : '' }}>
                                Rented</option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="price-range">Price Range
                            (€)</label>
                        <div class="range-slider">
                            <input type="text" id="price-range" name="priceRange" class="js-range-slider"
                                value="{{ old('priceRange', $selectedPriceRange) }}" />
                        </div>
                    </div>

                    <!-- Area Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="area_range">Area Range (meter
                            square)</label>
                        <div class="range-slider">
                            <input type="text" id="area_range" name="areaRange" class="area-js-range-slider"
                                data-plugin="range-slider" data-type="double" data-grid="true" data-min="0"
                                data-max="1000" data-from="200" data-to="800"
                                value="{{ old('areaRange', $selectedAreaRange) }}" />
                        </div>
                    </div>


                    <!-- Search Button -->
                    <div class="col-span-2 text-center mt-4">
                        <button type="submit"
                            class="bg-blue-500 text-white hover:bg-blue-600 px-15 py-3 rounded-md shadow-md">Apply
                            Filters</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- Properties image display --}}
        <div class="mt-5 partial">
            @include('property.partials-list')
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_3">
        <div class="modal-dialog">
            <div class="modal-content position-absolute">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data From XML FILE</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <form action="{{ route('property.import') }}" method="POST" id="xmlform">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="xmlUrl">XML File URL</label>
                                <input type="url" name="xmlUrl" id="xmlUrl" class="form-control"
                                    placeholder="Enter XML URL" required>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="xmlform">Import</button>
                </div>
            </div>
        </div>
    </div>

    <div id="loader"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


@endsection
@section('js')
    @include('property.area-js')
    <script>
        $(document).ready(function() {
            document.getElementById('xmlform').addEventListener('submit', function() {
                document.getElementById('loader').style.display = 'block';

            });
            document.getElementById('perpage').addEventListener('change', function() {
                // Get the selected value from the dropdown
                let perpage = this.value;

                // Redirect to the property.list route with the perpage parameter
                window.location.href = "{{ route('property.list') }}?perpage=" + perpage;
            });
            document.querySelectorAll('#toggle-description').forEach(function(button) {
                button.addEventListener('click', function() {
                    var card = this.closest('.card');
                    var shortDesc = card.querySelector('#short-description');
                    var fullDesc = card.querySelector('#full-description');

                    if (fullDesc.style.display === 'none') {
                        fullDesc.style.display = 'inline';
                        shortDesc.style.display = 'none';
                        this.textContent = 'Show Less';
                    } else {
                        fullDesc.style.display = 'none';
                        shortDesc.style.display = 'inline';
                        this.textContent = 'Show More';
                    }
                });
            });

            const filterButton = document.getElementById('filter-button');
            const filterCard = document.getElementById('filter-card');
            const filterIcon = document.getElementById('filter-icon');

            filterButton.addEventListener('click', () => {
                if (filterCard.classList.contains('max-h-0')) {
                    filterCard.classList.remove('max-h-0', 'opacity-0');
                    filterCard.classList.add('max-h-screen', 'opacity-100');
                    filterIcon.classList.remove('fa-chevron-down');
                    filterIcon.classList.add('fa-chevron-up');
                    filterIcon.style.transform = 'rotate(180deg)';
                } else {
                    filterCard.classList.remove('max-h-screen', 'opacity-100');
                    filterCard.classList.add('max-h-0', 'opacity-0');
                    filterIcon.classList.remove('fa-chevron-up');
                    filterIcon.classList.add('fa-chevron-down');
                    filterIcon.style.transform = 'rotate(0deg)';
                }
            });

            // Initialize range slider
            const rangeSliderMin = 10000;
            const rangeSliderMax = 1000000;
            const minPercent = (100 / (rangeSliderMax - rangeSliderMin)) * (rangeSliderMin - rangeSliderMin);
            const maxPercent = (100 / (rangeSliderMax - rangeSliderMin)) * (rangeSliderMax - rangeSliderMin);

            function updateSlider() {
                const minValue = parseInt(document.querySelector('#RangeSlider .range-slider-input-left').value);
                const maxValue = parseInt(document.querySelector('#RangeSlider .range-slider-input-right').value);
                const minPercent = (100 / (rangeSliderMax - rangeSliderMin)) * (minValue - rangeSliderMin);
                const maxPercent = (100 / (rangeSliderMax - rangeSliderMin)) * (maxValue - rangeSliderMin);

                document.querySelector('#RangeSlider .range-slider-val-left').style.width = `${minPercent}%`;
                document.querySelector('#RangeSlider .range-slider-val-right').style.width = `${100 - maxPercent}%`;
                document.querySelector('#RangeSlider .range-slider-val-range').style.left = `${minPercent}%`;
                document.querySelector('#RangeSlider .range-slider-val-range').style.right = `${100 - maxPercent}%`;
                document.querySelector('#RangeSlider .range-slider-handle-left').style.left = `${minPercent}%`;
                document.querySelector('#RangeSlider .range-slider-handle-right').style.left = `${maxPercent}%`;
                document.querySelector('#RangeSlider .range-slider-tooltip-left').style.left = `${minPercent}%`;
                document.querySelector('#RangeSlider .range-slider-tooltip-right').style.left = `${maxPercent}%`;

                document.querySelector('#RangeSlider .range-slider-tooltip-left .range-slider-tooltip-text')
                    .innerText = `€ ${minValue}`;
                document.querySelector('#RangeSlider .range-slider-tooltip-right .range-slider-tooltip-text')
                    .innerText = `€ ${maxValue}`;
            }

            document.querySelector('#RangeSlider .range-slider-input-left').addEventListener('input', updateSlider);
            document.querySelector('#RangeSlider .range-slider-input-right').addEventListener('input',
                updateSlider);

            updateSlider(); // Initialize slider position
        });
    </script>
    {{-- Property JS & CSS Blade Files --}}
    @include('property.min_max')
    @include('property.list-style')
@endsection
