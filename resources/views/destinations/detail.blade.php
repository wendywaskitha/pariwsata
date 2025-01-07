@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-4 card">
                    <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top"
                        alt="{{ $destination->name }}" style="max-height: 500px; object-fit: cover;" />
                    <div class="card-body">
                        <h1 class="card-title">{{ $destination->name }}</h1>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">
                                <i class="fas fa-tag me-1"></i>{{ $destination->category->name }}
                            </span>

                            <div class="text-warning">
                                @for ($i = 0; $i < 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i < $destination->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                <span class="text-muted ms-2">({{ $destination->reviews_count }} Reviews)</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4>Description</h4>
                            <p>{{ $destination->description }}</p>
                        </div>

                        <div class="mb-4">
                            <h4>Location</h4>
                            <p>
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $destination->address }}
                            </p>

                            <!-- Embedded Map (Optional) -->
                            @if ($destination->latitude && $destination->longitude)
                                <div style="width: 100%; height: 400px;" id="map"></div>
                            @endif
                        </div>

                        @if ($destination->contact_info)
                            <div class="mb-4">
                                <h4>Contact Information</h4>
                                <p>{{ $destination->contact_info }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews Section (Optional) -->
                @if ($destination->reviews->count() > 0)
                    <div class="mb-4 card">
                        <div class="card-header">
                            <h4>Reviews</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($destination->reviews as $review)
                                <div class="pb-3 mb-3 border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <h5>{{ $review->user->name }}</h5>
                                        <div class="text-warning">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p>{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Similar Destinations</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($similarDestinations as $similar)
                            <div class="mb-3">
                                <a href="{{ route('destination.show', $similar->id) }}" class="text-decoration-none">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/' . $similar->image) }}" alt="{{ $similar->name }}"
                                            class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                        <div>
                                            <h5 class="mb-1">{{ $similar->name }}</h5>
                                            <p class="text-muted small">{{ $similar->category->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Map Integration Script -->
    @if ($destination->latitude && $destination->longitude)
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script>
            var map = L.map('map').setView([{{ $destination->latitude }}, {{ $destination->longitude }}], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([{{ $destination->latitude }}, {{ $destination->longitude }}])
                .addTo(map)
                .bindPopup('{{ $destination->name }}')
                .openPopup();
        </script>
    @endif
@endsection
