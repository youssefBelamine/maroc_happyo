<div class="min-vh-100 bg-light">
    <!-- Navigation with icons -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 text-primary d-flex align-items-center" wire:navigate href="#">
                <i class="bi bi-shop-window me-2"></i>
                <span>Maroc Happyo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @auth
                    @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-medium px-3 py-2 rounded d-flex align-items-center" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                tableau de bord
                            </a>
                        </li>
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium px-3 py-2 rounded d-flex align-items-center" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ auth()->user()->prenom }}
                        </a>
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-medium px-3 py-2 rounded d-flex align-items-center" href="/login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Se connecter
                            </a>
                        </li>
                        @endauth
                    <li class="nav-item">
                        <button class="btn btn-primary px-4 py-2 fw-bold shadow-sm d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i>
                            <a class="nav-link text-light fw-medium px-3 py-2 rounded d-flex align-items-center"
                             href="{{ route('annonce') }}">
                                Publier une annonce
                            </a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            <!-- Hero Section with icon -->
            <div class="mb-5">
                <h1 class="fw-bold text-primary mb-3 d-flex align-items-center">
                    <i class="bi bi-house-heart me-3"></i>
                    Bienvenue sur Maroc Happyo
                </h1>
                <p class="lead text-muted">
                    <i class="bi bi-search me-2"></i>
                    Trouvez et publiez vos annonces facilement.
                </p>
            </div>

            <!-- Categories Section with icon -->
            <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="h5 mb-0 text-primary fw-semibold d-flex align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                        Catégories
                    </h2>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button 
                        wire:click="resetChildren"
                        type="button" 
                        class="btn {{$catId == null ? "btn-primary" : "btn-outline-primary"  }} px-4 py-2 rounded-pill fw-bold d-flex align-items-center"
                    >
                        <i class="bi bi-grid-fill me-2"></i>
                        Tout
                    </button>
                    @foreach ($Categories as $cat)
                        <button 
                            wire:click="getChildren({{ $cat->id }}, '{{$cat->name}}')"
                            type="button" 
                            class="btn {{$catId == $cat->id ? "btn-primary" : "btn-outline-primary"  }} px-4 py-2 rounded-pill fw-bold d-flex align-items-center gap-2"
                        >
                            <i class="bi bi-tag-fill me-1"></i>
                            {{ $cat->name }}
                            @if ($this->hasChildren($cat->id))
                                <i class="bi bi-chevron-down small"></i>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
            
            <!-- Subcategories Section with icons -->
            @if ($children)
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-3">
                    <h3 class="h5 mb-0 text-success fw-semibold d-flex align-items-center">
                        <i class="bi bi-diagram-2-fill me-2"></i>
                        {{ $parent }} catégories
                    </h3>
                    <div class="d-flex flex-wrap gap-2">
                        @if ($currentId)
                        <button
                        wire:click="goBack"
                        class="btn btn-success px-3 py-2 rounded-pill fw-bold d-flex align-items-center shadow-sm"
                        style=" margin-right: 50px;"
                        >
                        <i class="bi bi-arrow-left-circle-fill me-1 fs-5"></i>
                        <span class="position-relative" style="top: 1px;">Retour</span>
                    </button>
                        @endif
                        
                        @foreach ($children as $child)
                            <button 
                                wire:click="getChildren({{ $child->id }}, '{{$child->name}}', '{{true}}')"
                                type="button" 
                                class="btn  {{$catId == $child->id ? "btn-success" : "btn-outline-success"  }} px-4 py-2 rounded-pill fw-bold d-flex align-items-center gap-2"
                            >
                                <i class="bi bi-tag me-1"></i>
                                {{ $child->name }}
                                @if ($this->hasChildren($child->id))
                                    <i class="bi bi-chevron-down small"></i>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
                </div>
            @endif
            {{-- {{$currentId}} / {{$catId}} --}}

            {{-- @foreach ($IDs_category_and_children as $id)
                <span> / {{$id}} </span>
            @endforeach --}}

            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    <!-- Repeat your announcement card component -->
                    <div class="col">
                        {{-- @foreach($announcements as $announcement)
    <x-annonce-card 
        name="{{ $announcement->user->name }}"
        since="{{ $announcement->created_at->diffInDays() }}"
        image="{{ $announcement->images->first()->url ?? 'fallback-image.jpg' }}"
        imagesNumber="{{ $announcement->images->count() }}"
        category="{{ $announcement->category->name }}"
        city="{{ $announcement->city->name }}"
        territory="{{ $announcement->territory->name }}"
        title="{{ $announcement->title }}"
        price="{{ $announcement->price }}"
    />
@endforeach --}}
                    </div>
                    {{-- <div class="col">
                        <x-annonce-card />
                    </div>
                    <div class="col">
                        <x-annonce-card />
                    </div>
                    <div class="col">
                        <x-annonce-card />
                    </div> --}}
                    <!-- Add more cards as needed -->
                </div>
            </div>

        </div>
    </main>
</div>