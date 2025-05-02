<div class="min-vh-100 bg-light d-flex flex-column">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Brand -->
            <span class="navbar-brand fw-bold fs-4 text-primary d-flex align-items-center">
                <i class="bi bi-shop-window me-2"></i>
                <span>Maroc Happyo</span>
            </span>

            <!-- Operation Title -->
            <div class="mx-auto">
                <h2 class="h4 mb-0 text-dark fw-semibold d-flex align-items-center">
                    <i class="bi bi-plus-circle me-2"></i>
                    Créer votre annonce
                </h2>
            </div>

            <!-- Exit Button -->
            <div>
                <button onclick="return confirm('Voulez-vous vraiment annuler la création de cette annonce?') ? window.location.href='/' : false"
                    class="btn btn-outline-danger px-4 py-2 fw-bold">
                    <i class="bi bi-x-lg me-1"></i>
                    Annuler
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Form Area -->
    <main style="height: 70vh" class="py-4 flex-grow-1 overflow-auto">
        <div class="container-fluid px-5">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">

                            <form wire:submit.prevent="continue" class="mb-4">
                                @if ($step == 1)
                                    <!-- Annonce Info -->
                                <h4 class="mb-4">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Informations 
                                </h4>

                                <!-- Categories -->
                                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <h2 class="h5 mb-0 text-primary fw-semibold d-flex align-items-center">
                                            <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                                             Choisissez une Catégorie
                                        </h2>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button wire:click="resetChildren" type="button"
                                            class="btn btn-outline-primary px-4 py-2 rounded-pill fw-bold d-flex align-items-center">
                                            <i class="bi bi-grid-fill me-2"></i>
                                            Tout
                                        </button>
                                        @foreach ($this->getCategories() as $cat)
                                        
                                            <button wire:click="getChildren({{ $cat->id }}, '{{ $cat->name }}')" type="button"
                                                class="btn btn-outline-primary px-4 py-2 rounded-pill fw-bold d-flex align-items-center gap-2">
                                                <i class="bi bi-tag-fill me-1"></i>
                                                {{ $cat->name }}
                                                @if ($this->hasChildren($cat->id))
                                                    <i class="bi bi-chevron-down small"></i>
                                                @endif
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Subcategories -->
                                @if ($children)
                                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-3">
                                            <h3 class="h5 mb-0 text-success fw-semibold d-flex align-items-center">
                                                <i class="bi bi-diagram-2-fill me-2"></i>
                                                {{ $parent }} catégories
                                            </h3>

                                            <div class="d-flex flex-wrap gap-2">
                                                @if ($currentId)
                                                    <button wire:click="goBack"
                                                        class="btn btn-success px-3 py-2 rounded-pill fw-bold d-flex align-items-center shadow-sm">
                                                        <i class="bi bi-arrow-left-circle-fill me-1 fs-5"></i>
                                                        <span class="position-relative" style="top: 1px;">Retour</span>
                                                    </button>
                                                @endif
                                                @foreach ($children as $child)
                                                @php
                                                    $isSelected = $selectedCategoryId == $child->id;
                                                @endphp
                                                    <button wire:click="getChildren({{ $child->id }}, '{{ $child->name }}', 'true')" type="button"
                                                        class="btn  {{ $isSelected ? 'btn-success text-white' : 'btn-outline-success' }}  px-4 py-2 rounded-pill fw-bold d-flex align-items-center gap-2">
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

                                <!-- Address -->
                                <h4 class="mb-4">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Votre Adresse
                                </h4>

                                <!-- City -->
                                <div class="mb-4">
                                    <label for="city" class="form-label fw-bold">Ville</label>
                                    <select wire:change="getTerritories($event.target.value)" id="city" class="form-select w-75">
                                        <option value="">Sélectionnez une ville</option>
                                        @foreach ($this->getCities() as $city)
                                            <option {{$selectedCityId == $city->id ? "selected" : ""}} value="{{ $city->id }}">{{ $city->ville }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCityId') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <!-- Sector -->
                                @if ($cityTerritories)
                                    <div class="mb-4">
                                        <label for="territory" class="form-label fw-bold">Secteur</label>
                                        <select id="territory" class="form-select w-75"
                                        wire:change = "setSecteurId($event.target.value)"
                                        >
                                            <option value="" {{!$secteurId ? "selected" : ""}} >Sélectionnez un secteur</option>
                                            @foreach ($cityTerritories as $territory)
                                                <option {{$secteurId == $territory->id ? "selected" : ""}} value="{{ $territory->id }}">{{ $territory->secteur }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedCityId') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                @endif

                                <!-- Contact Info -->
                                <div class="mb-">
                                    <h4 class="mb-4">
                                        <i class="bi bi-telephone me-2"></i>
                                        Vos coordonnées
                                    </h4>
                                    <label for="tel" class="form-label fw-bold">Numéro de téléphone</label>
                                    <input type="text" class="form-control w-50" name="tel"
                                        value="{{ auth()->user()->tel }}" disabled>
                                </div>
                                @endif

                                @if ($step == 2)
                                    <!-- Step 2: Announcement Details -->
                                <section class="mb-4">
                                    <h4 class="mb-4 text-primary d-flex align-items-center">
                                        <i class="bi bi-card-text me-2"></i>
                                        Détails de l'annonce
                                    </h4>

                                    <!-- Dynamic Fields -->
                                    @foreach ($this->getFields() as $field)
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">{{ $field->label }}</label>
                                        
                                        @if ($field->type == 'text')
                                            <input type="text" wire:model.defer="{{ $field->nom }}" 
                                                class="form-control">
                                        @elseif ($field->type == "select")
                                            <select wire:change = "setFieldValue('{{ $field->id }}', $event.target.value)" 
                                                class="form-select">
                                                <option value="">Choisissez {{ $field->label }}</option>
                                                @foreach ($this->getOptions($field->id) as $option)
                                                    <option value="{{ $option->valeur }}">{{ $option->etiquette }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($field->type == "radio")
                                            <div class="d-flex flex-wrap gap-3 mt-2">
                                                @foreach ($this->getOptions($field->id) as $option)
                                                    <div class="form-check">

                                                        <button
                                                        wire:click = "setFieldValue('{{ $field->id }}', '{{ $option->valeur }}')"
                                                        >
                                                            {{ $option->etiquette }}
                                                        </button>

                                                        {{-- <input class="form-check-input" type="radio" 
                                                            
                                                            name="{{ $field->nom }}" 
                                                            value="{{ $option->valeur }}" 
                                                            id="{{ $field->nom }}_{{ $option->id }}">
                                                        <label class="form-check-label" for="{{ $field->nom }}_{{ $option->id }}">
                                                            {{ $option->etiquette }}
                                                        </label> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @elseif ($field->type == 'textarea')
                                            <textarea wire:model.defer="{{ $field->nom }}" 
                                                class="form-control" rows="3"></textarea>
                                        @endif
                                        
                                        @error($field->nom) 
                                            <div class="text-danger small mt-1">{{ $message }}</div> 
                                        @enderror
                                    </div>
                                    @endforeach

                                    <!-- Fixed Fields -->
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Prix (DH)</label>
                                            <input type="number" min="0" class="form-control" placeholder="0">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Titre de l'annonce</label>
                                            <input type="text" class="form-control" placeholder="Titre descriptif">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Description</label>
                                            <textarea class="form-control" rows="5" placeholder="Décrivez votre annonce en détail"></textarea>
                                        </div>
                                    </div>
                                </section>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white py-3 border-top sticky-bottom">
    <div class="container-fluid px-lg-5 px-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                @if ($step > 1)
                    <button type="button"
                    wire:click="goBackStep"
                    class="btn btn-outline-secondary px-4 py-2 fw-bold">
                        <i class="bi bi-arrow-left me-2"></i>
                        Retour
                    </button>
                @endif
            </div>
            {{-- {{$fieldsValues}} --}}
            <div class="col-auto">
                <button type="button"
                wire:click="goNext"
                class="btn btn-{{ $this->checkContinue() ? 'primary' : 'secondary' }} px-4 py-2 fw-bold"
                {{ !$this->checkContinue() ? 'disabled' : '' }}>
                    {{ $step == 3 ? 'Publier' : 'Continuer' }}
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</footer>
</div>
