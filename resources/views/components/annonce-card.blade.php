@props([
    'name' => "Youssef",
    'since' => 10,
    'image' => "unknownImage.jpg",
    'imagesNumber' => 0,
    'category' => "Smartphone et Téléphone",
    'city' => "Agadir",
    'territory' => "Assaka",
    'title' => "Galaxy ",
    'price' => 1200
])

<div class="card mb-4 shadow-sm" style="height: 420px; display: flex; flex-direction: column;">
    {{-- Header with profile --}}
    <div class="d-flex align-items-center p-3" style="flex-shrink: 0;">
        <div class="me-3">
            <img src="unknownProfile.jpg" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </div>
        <div>
            <p class="mb-0 fw-bold">{{ $name }}</p>
            <p class="mb-0 text-muted small">Il y a {{ $since }} </p>
        </div>
    </div>

    {{-- Image container with fixed height --}}
    <div class="position-relative" style="height: 250px; overflow: hidden;">
        <img src="{{ $image }}" alt="Announcement" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover;">
        
        @if ($imagesNumber > 0)
        <div class="position-absolute bottom-0 end-0 bg-dark bg-opacity-75 text-white p-2 rounded-top-start">
            <i class="bi bi-camera-fill me-1"></i>
            <span>{{ $imagesNumber }}</span>
        </div>
        @endif
    </div>

    {{-- Announcement details --}}
    <div class="card-body" style="flex-shrink: 0;">
        <p class="card-text text-muted small mb-1">
            {{ $category }} dans {{ $city }} {{ $territory }}
        </p>
        <h5 class="card-title mb-1">{{ $title }}</h5>
        <p class="card-text fw-bold text-primary mb-0">{{ number_format($price, 0, ',', ' ') }} DH</p>
    </div>
</div>
