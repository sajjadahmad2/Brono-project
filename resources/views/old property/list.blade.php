@extends('layouts.app')

@section('title', 'Properties')
@section('css')
    <style>
        .carousel-image {
            height: 300px;
            /* Adjust this value as needed */
            object-fit: cover;
            /* This ensures the image covers the container without stretching */
        }

        .pagination p {
            display: none;
        }
    </style>
@endsection
@section('content')
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
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row p-4">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_3">
                Import XML
            </button>
            <a href="{{ route('property.add') }}" class="btn btn-primary"><i></i>Add New</a>
        </div>
    </div>

    <div class="container mx-auto p-5 ">
        <!-- Main Div to Click (Filter) -->
        <div class="bg-white rounded-lg shadow-md cursor-pointer flex items-center p-4" id="filter-button">
            <i class="fas fa-filter text-blue-500 text-2xl mr-3" id="filter-icon"></i>
            <span class="text-xl font-semibold">Filter</span>
        </div>

        <!-- Filter Form Card (Initially Hidden) -->
        <div class="bg-white rounded-lg shadow-md mt-6 p-6 transition-height transition-opacity overflow-hidden max-h-0 opacity-0"
            id="filter-card">
            <h3 class="text-2xl font-bold mb-4">Search Properties</h3>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Enter Your Keyword -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="keyword">Enter Your
                            Keyword</label>
                        <input id="keyword"
                            class="form-input mt-1 p-3.5 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Search..." type="text" />
                    </div>

                    <!-- Select Location -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="location">Select Location</label>
                        <select id="location" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Locations</option>
                            @foreach ($location_detail as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Property Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="property-type">Property
                            Type</label>
                        <select id="property-type"
                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Types</option>
                            @foreach ($types as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Category -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="category">Select Category</label>
                        <select id="category" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Categories</option>
                            <option value="1">New Build</option>
                            <option value="0">Rented</option>

                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="price-range">Price Range</label>
                        <input id="price-range" class="form-range w-full mt-1" type="range" max="1000000" min="10000"
                            value="500000" />
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>$ {{ $minPrice }}</span>
                            <span>$ {{ $maxPrice }}</span>
                        </div>
                    </div>

                    <!-- Area Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="area-range">Area Range (sq
                            ft)</label>
                        <input id="area-range" class="form-range w-full mt-1" type="range" max="5000" min="500"
                            value="2000" />
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>500 sq ft</span>
                            <span>5,000 sq ft</span>
                        </div>
                    </div>
                    <!-- Per Page Filter -->
                    <div class="form-group">
                        <label for="perpage">Items per page:</label>
                        <select id="perpage" name="perpage" class="form-control">
                            <option value="12" {{ request('perpage') == 12 ? 'selected' : '' }}>12</option>
                            <option value="24" {{ request('perpage') == 24 ? 'selected' : '' }}>24</option>
                            <option value="36" {{ request('perpage') == 36 ? 'selected' : '' }}>36</option>
                        </select>
                    </div>
                    <!-- Search Button -->
                    <div class="col-span-2 text-center mt-4">
                        <button type="submit"
                            class="bg-blue-500 text-white hover:bg-blue-600 px-15 py-3 rounded-md shadow-md">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="kt_modal_3">
        <div class="modal-dialog">
            <div class="modal-content position-absolute">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data From XML FILE</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <form action="{{ route('property.import') }}" method="POST" enctype="multipart/form-data"
                        id="xmlform">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="xmlFile">Select XML File</label>
                                <input type="file" name="xmlFile" id="xmlFile" class="form-control" accept=".xml"
                                    required>
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


    {{--  Properties image display  --}}
    @include('property.partials-list')




@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                var formData = {
                    keyword: $('#keyword').val(),
                    location: $('#location').val(),
                    propertyType: $('#property-type').val(),
                    category: $('#category').val(),
                    priceRange: $('#price-range').val(),
                    areaRange: $('#area-range').val()
                };

                $.ajax({
                    url: '{{ route('property.list') }}', // Replace with your endpoint URL
                    type: 'GET',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // If using Laravel, include the CSRF token
                    },
                    success: function(response) {
                        $('.property-list').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('An error occurred:', error);
                    }
                });
            });
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
    </script>


@endsection
