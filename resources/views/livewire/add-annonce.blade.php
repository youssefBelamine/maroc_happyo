<div class="min-vh-100 bg-light d-flex flex-column">
    @script
    <script>
        // Handle notifications
        Livewire.on('notify', (data) => {
            alert(data.message);
        });
        Livewire.on('annonceCreated', (data) => {
            alert(data.message);
        });
        Livewire.on('annonce-creation-failed', (data) => {
            alert(data.message);
        });
        
        // Handle skip images confirmation
        Livewire.on('confirm-skip', (data) => {
            if (confirm(data.message)) {
                Livewire.dispatch('skip-images-confirmed');
            }
        });
    </script>
    @endscript
    
    

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
                <button
                    onclick="return confirm('Voulez-vous vraiment annuler la création de cette annonce?') ? window.location.href='/' : false"
                    class="btn btn-outline-danger px-4 py-2 fw-bold">
                    <i class="bi bi-x-lg me-1"></i>
                    Annuler
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="height: 70vh" class="py-4 flex-grow-1 overflow-auto">
        <div class="container-fluid px-5">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <!-- FORM -->
                            <form wire:submit.prevent="publish" enctype="multipart/form-data" class="mb-4">
                            @csrf
                                <!-- Step 1: Informations -->
                                @if ($step == 1)
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 ">
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                                            @foreach ($this->getCategories() as $cat)
                                                <button
                                                    wire:click="getChildren({{ $cat->id }}, '{{ $cat->name }}')"
                                                    type="button"
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
                                                        <button wire:click="goBack" type="button"
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
                                                            class="btn {{ $isSelected ? 'btn-success text-white' : 'btn-outline-success' }} px-4 py-2 rounded-pill fw-bold d-flex align-items-center gap-2">
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

                                    <!-- Address Section -->
                                    <h4 class="mb-4">
                                        <i class="bi bi-geo-alt me-2"></i>
                                        Votre Adresse
                                    </h4>

                                    <!-- City Select -->
                                    <div class="mb-4">
                                        <label for="city" class="form-label fw-bold">Ville</label>
                                        <select wire:change="getTerritories($event.target.value)" id="city" class="form-select w-75">
                                            <option value="">Sélectionnez une ville</option>
                                            @foreach ($this->getCities() as $city)
                                                <option {{ $selectedCityId == $city->id ? "selected" : "" }} value="{{ $city->id }}">
                                                    {{ $city->ville }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('selectedCityId') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Sector Select -->
                                    @if ($cityTerritories)
                                        <div class="mb-4">
                                            <label for="territory" class="form-label fw-bold">Secteur</label>
                                            <select id="territory" class="form-select w-75" wire:change="setSecteurId($event.target.value)">
                                                <option value="" {{ !$secteurId ? "selected" : "" }}>Sélectionnez un secteur</option>
                                                @foreach ($cityTerritories as $territory)
                                                    <option {{ $secteurId == $territory->id ? "selected" : "" }} value="{{ $territory->id }}">
                                                        {{ $territory->secteur }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('selectedCityId') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    @endif

                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <h4 class="mb-4">
                                            <i class="bi bi-telephone me-2"></i>
                                            Vos coordonnées
                                        </h4>
                                        <label for="tel" class="form-label fw-bold">Numéro de téléphone</label>
                                        <input type="text" class="form-control w-50" name="tel" value="{{ auth()->user()->tel }}" disabled>
                                    </div>
                                @endif

                                <!-- Step 2: Détails de l'annonce -->
                                @if ($step == 2)
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
                                                    <input type="text" class="form-control" wire:model="fieldsValues.{{ $field->id }}">

                                                @elseif ($field->type == "number")
                                                    <input type="number" min="0" class="form-control" wire:model="fieldsValues.{{ $field->id }}">

                                                @elseif ($field->type == "select")
                                                    <select wire:model="fieldsValues.{{ $field->id }}" class="form-select">
                                                        <option value="">Choisissez {{ $field->label }}</option>
                                                        @foreach ($this->getOptions($field->id) as $option)
                                                            <option value="{{ $option->valeur }}">
                                                                {{ $option->etiquette }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                @elseif ($field->type == "radio")
                                                    <div class="d-flex flex-wrap gap-3 mt-2">
                                                        @foreach ($this->getOptions($field->id) as $option)
                                                            <div class="form-check text-white">
                                                                <button id="optionBtn"
                                                                    type="button"
                                                                    class="btn btn-sm px-3 py-2 fw-semibold rounded-pill shadow-sm 
                                                                        {{ $this->checkSelectedOption($field->id, $option->valeur) == $option->valeur ? 'btn-primary text-white' : 'btn-outline-primary text-primary' }}"
                                                                    wire:click="setFieldValue('{{ $field->id }}', '{{ $option->valeur }}')">
                                                                    {{ $option->etiquette }}
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @elseif ($field->type == 'textarea')
                                                    <textarea class="form-control" rows="3" wire:model="fieldsValues.{{ $field->id }}"></textarea>
                                                @endif

                                                @error('fieldsValues.'.$field->id)
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach

                                        <!-- Fixed Fields -->
                                        <h4 class="mb-4 text-primary d-flex align-items-center">
                                            <i class="bi bi-info-circle me-2"></i>
                                            Information de l'annonce
                                        </h4>
                                        
                                        <div class="row g-3">
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Prix (DH)</label>
                                                <input type="number" min="0" wire:model="price" class="form-control" placeholder="0">
                                                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Titre de l'annonce</label>
                                                <input type="text" wire:model="title" class="form-control" placeholder="Titre descriptif">
                                                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea class="form-control" rows="5" wire:model="description" placeholder="Décrivez votre annonce en détail"></textarea>
                                                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </section>
                                @endif

                                <!-- Step 3 -->
                                @if ($step == 3)
                                    <section class="mb-4">
                                        <h4 class="mb-4 text-primary d-flex align-items-center">
                                            <i class="bi bi-images me-2"></i>
                                            Ajoutez des images
                                        </h4>

                                        <div class="border border-2 border-dashed rounded-3 p-5 text-center bg-light"
                                            wire:drop.prevent
                                            wire:dragover.prevent>
                                            <input type="file"
                                                wire:model="images"
                                                multiple
                                                accept="image/*"
                                                class="form-control d-none"
                                                id="imagesInput">

                                            <label for="imagesInput" class="cursor-pointer d-block">
                                                <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
                                                <p class="fw-semibold mt-3">Glissez-déposez vos images ici ou cliquez pour les sélectionner</p>
                                                <p class="small text-muted">Jusqu'à 5 images. Taille max: 2MB chacune.</p>
                                            </label>

                                            @error('images.*') 
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Previews -->
                                        @if ($images)
                                            <div class="mt-4 d-flex flex-wrap gap-3">
                                                @foreach ($images as $index => $image)
                                                    <div class="border p-2 rounded shadow-sm position-relative">
                                                        <img src="{{ $image->temporaryUrl() }}" width="120" class="rounded">
                                                        <button type="button"
                                                                wire:click="removeImage({{ $index }})"
                                                                class="btn-close position-absolute top-0 end-0 m-1"
                                                                aria-label="Remove"></button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        {{-- <div class="mt-4 text-center">
                                            <button type="button" wire:click="confirmSkipImages" 
                                                class="btn btn-outline-secondary px-4 py-2">
                                                <i class="bi bi-arrow-right-circle me-2"></i>
                                                Continuer sans images
                                            </button>
                                        </div> --}}
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
                        <button type="button" wire:click="goBackStep"
                            class="btn btn-outline-secondary px-4 py-2 fw-bold">
                            <i class="bi bi-arrow-left me-2"></i>
                            Retour
                        </button>
                    @endif
                </div>
                <div class="col-auto">
                    @if ($step == 3)
                        <button wire:click="publish" 
                            class="btn btn-success px-4 py-2 fw-bold">
                            <i class="bi bi-check-circle me-2"></i>
                            Publier l'annonce
                        </button>
                    @else
                        <button type="button" wire:click="goNext"
                            class="btn btn-primary px-4 py-2 fw-bold"
                            {{-- {{ $ableToGoNext ? '' : 'disabled' }} --}}
                            >
                            Continuer
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </footer>
</div>