<div class="property-list">

    <div class="row g-6">
        @forelse ($properties as $property)

            <div class="col-lg-3 col-md-4  col-sm-6">
                <a href="{{ route('property.edit', $property-> id) }}">
                <div class="card shadow-sm rounded border-0 overflow-hidden">
                    <!-- Carousel Section -->
                    <div class="position-relative">
                        @if ($property->images->isNotEmpty())
                            <div id="carousel-{{ $property->id }}" class="carousel slide" data-bs-interval="false">

                                <div class="carousel-inner">
                                    @foreach ($property->images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->url) }}" alt="Property Image"
                                                class="d-block w-100 carousel-image" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Controls -->
                                <a class="carousel-control-prev" href="#carousel-{{ $property->id }}" role="button"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-white rounded-circle" aria-hidden="true">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-{{ $property->id }}" role="button"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-white rounded-circle" aria-hidden="true">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="visually-hidden">Next</span>
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
                        <h4 class="text-xl font-semibold leading-none text-gray-900">
                            €{{ number_format($property->price, 0) }}
                        </h4><br>
                        <p class="text-muted">
                            <i class="fas fa-bed"></i> {{ $property->beds }} Beds &nbsp; | &nbsp;
                            <i class="fas fa-bath"></i> {{ $property->baths }} Baths &nbsp; | &nbsp;
                            {!! $property->pool ? '<i class="fas fa-swimming-pool"></i> Pool' : '' !!}
                        </p>
                        <p class="card-text text-muted mt-2">
                            <span id="short-description-{{ $property->id }}">
                                {!! Str::limit(strip_tags($property->descriptionEn?->description), 200) !!}
                            </span>
                            {{-- <span id="full-description-{{ $property->id }}" style="display:none;">
                                {!! $property->descriptionEn->description !!}
                            </span> --}}
                        </p>
                    </div>
                </div>
            </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <strong>No properties found!</strong> Please adjust your filters or check back later.
                </div>
            </div>
        @endforelse
    </div>


    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $properties->links() }}
    </div>
</div>
