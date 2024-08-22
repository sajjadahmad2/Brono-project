@extends('layouts.app')

@section('title', 'Properties')

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
        <div class="bg-white rounded-lg shadow-md mt-6 p-6 transition-height transition-opacity overflow-hidden max-h-0 opacity-0" id="filter-card">
            <h3 class="text-2xl font-bold mb-4">Search Properties</h3>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Enter Your Keyword -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="keyword">Enter Your Keyword</label>
                        <input id="keyword" class="form-input mt-1 p-3.5 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Search..." type="text" />
                    </div>

                    <!-- Select Location -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="location">Select Location</label>
                        <select id="location" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Locations</option>
                          @foreach($location_detail as $value)
                          <option value="{{ $value }}">{{ $value }}</option>
                          @endforeach

                        </select>
                    </div>

                    <!-- Property Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="property-type">Property Type</label>
                        <select id="property-type" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="all">All Types</option>
                            @foreach($types as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Category -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="category">Select Category</label>
                        <select id="category" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Categories</option>
                            <option value="buy">Buy</option>
                            <option value="rent">Rent</option>
                            <option value="sale">Sale</option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="price-range">Price Range</label>
                        <input id="price-range" class="form-range w-full mt-1" type="range" max="1000000" min="10000" value="500000" />
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>{{ $minPrice }}</span>
                            <span>{{ $maxPrice }}</span>
                        </div>
                    </div>

                    <!-- Area Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="area-range">Area Range (sq ft)</label>
                        <input id="area-range" class="form-range w-full mt-1" type="range" max="5000" min="500" value="2000" />
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>500 sq ft</span>
                            <span>5,000 sq ft</span>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-span-2 text-center mt-4">
                        <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 px-15 py-3 rounded-md shadow-md">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
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

    {{--  Properties image display  --}}
    <div class="container mx-auto mt-8">
        <div class="row g-6">
            @foreach ($properties as $property)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card shadow-sm rounded border-0 overflow-hidden">
                        <!-- Carousel Section -->
                        <div class="position-relative">
                            @if (isset($property->images) && $property->images->count() > 0)
                                <div id="carousel-{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($property->images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image->url) }}" alt="Location Image" class="d-block w-100 carousel-image" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Controls -->
                                    <a class="carousel-control-prev" href="#carousel-{{ $property->id }}" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-white rounded-circle" aria-hidden="true">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-{{ $property->id }}" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-white rounded-circle" aria-hidden="true">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                        <span class="visually-hidden ">Next</span>
                                    </a>
                                </div>
                            @endif

                            <!-- Location and Badge -->
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-light text-dark py-2 px-3 shadow-sm">
                                    <i class="fas fa-map-marker-alt"></i> &nbsp; {{ $property->location_detail }}
                                </span>
                            </div>
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary py-2 px-3 shadow-sm">
                                    For {{ $property->price_freq }}
                                </span>
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="card-body">
                            <h4 class="text-xl font-semibold leading-none text-gray-900">€ {{ number_format($property->price, 0) }}</h4><br>
                            <p class="text-muted">
                                <i class="fas fa-bed"></i> {{ $property->beds }} Beds &nbsp; | &nbsp;
                                <i class="fas fa-bath"></i> {{ $property->baths }} Baths &nbsp; | &nbsp;
                                {!! $property->pool ? '<i class="fas fa-swimming-pool"></i> Pool' : '' !!}
                            </p>
                            <p class="card-text text-muted mt-2">
                                <span id="short-description-{{ $property->id }}">
                                    {!! Str::limit(strip_tags($property->descriptionEn->description), 200) !!}
                                </span>
                                <span id="full-description-{{ $property->id }}" style="display:none;">
                                    {!! $property->descriptionEn->description !!}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination and Item Count Controls -->
        @if ($properties instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="lg:col-span-2 mt-4">
            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                <div class="flex items-center gap-2 order-2 md:order-1">
                    Show
                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage" onchange="location = this.value;">
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 5]) }}" {{ request('perpage') == 5 ? 'selected' : '' }}>5</option>
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 10]) }}" {{ request('perpage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 20]) }}" {{ request('perpage') == 20 ? 'selected' : '' }}>20</option>
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 30]) }}" {{ request('perpage') == 30 ? 'selected' : '' }}>30</option>
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 50]) }}" {{ request('perpage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 50]) }}" {{ request('perpage') == 75 ? 'selected' : '' }}>75</option>
                        <option value="{{ request()->fullUrlWithQuery(['perpage' => 50]) }}" {{ request('perpage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    per page
                </div>

                <div class="flex justify-end ">
                    <div class="pagination"  data-datatable-pagination="true">
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>


        @endif
    </div>




    <style>
        .carousel-image {
            height: 300px;
            /* Adjust this value as needed */
            object-fit: cover;
            /* This ensures the image covers the container without stretching */
        }
        .pagination p{
            display: none;
        }
    </style>


    <script>
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
    </script>





    {{--  $properties = Property::select('image_url', 'longitude', 'latitude')->paginate(20);
        <div class="pagination">
            {{ $properties->links() }}
        </div>  --}}

    {{--  <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead class="thead-light" style="font-weight: bold">
                                <tr>
                                    <th>Ref</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Price Frequency</th>
                                    <th>New Build</th>
                                    <th>Type</th>
                                    <th>Town</th>
                                    <th>Province</th>
                                    <th>Location Detail</th>
                                    <th>Beds</th>
                                    <th>Baths</th>
                                    <th>Pool</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr><!--end tr-->
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="xmlform">Import</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        // Datatable
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ route('property.list') }}",
            },
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'currency',
                    name: 'currency'
                },
                {
                    data: 'price_freq',
                    name: 'price_freq'
                },
                {
                    data: 'new_build',
                    name: 'new_build'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'town',
                    name: 'town'
                },
                {
                    data: 'province',
                    name: 'province'
                },
                {
                    data: 'location_detail',
                    name: 'location_detail'
                },
                {
                    data: 'beds',
                    name: 'beds'
                },
                {
                    data: 'baths',
                    name: 'baths'
                },
                {
                    data: 'pool',
                    name: 'pool'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-right'
                },
            ]
        });
    </script>  --}}

@endsection
