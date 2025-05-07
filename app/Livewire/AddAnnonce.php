<?php

namespace App\Livewire;

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AnnounceImage;
use App\Models\Announce;
use App\Models\ValeursChamp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class AddAnnonce extends Component
{
    use WithFileUploads;
    
    // Step management
    public $step = 1;
    // public $ableToGoNext = false;

    // Category selection
    public $children = [];
    public $currentId = null;
    public $parent = "";
    public $selectedCategoryId = null;

    // City and territory
    public $selectedCityId = null;
    public $cityTerritories = [];
    public $secteurId = null;

    // Form values
    public $fieldsValues = [];
    public $price = null;
    public $title = "";
    public $description = "";

    // Images
    public $images = [];
    public $skipImages = false;

    /**
     * Component mount lifecycle hook
     */
    public function mount()
    {
        $this->getCategories();
        $this->getCities();
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function getCategories()
    {
        return Categorie::with('children.children')
            ->whereNull('parent_id')
            ->get();
    }

    public function resetChildren()
    {
        $this->children = [];
        $this->parent = "";
        $this->currentId = null;
        $this->selectedCategoryId = null;
    }

    public function hasChildren($id)
    {
        return DB::table("categories")
            ->where("parent_id", $id)
            ->exists();
    }

    public function getChildren($id, $parent = "", $goBack = false)
    {
        if ($this->hasChildren($id)) {
            $this->currentId = $goBack ? $id : null;
            $this->parent = $parent;
            $this->children = DB::table("categories")
                ->where("parent_id", $id)
                ->get();
            $this->selectedCategoryId = null;
        } else {
            $this->selectedCategoryId = $id;
        }

        // $this->checkContinue();

    }

    public function goBack()
    {
        // dd("Go back method called");
        $currentCat = DB::table("categories")->find($this->currentId);
        $previousCat = DB::table("categories")->find($currentCat->parent_id);

        $this->getChildren($previousCat->id, $previousCat->name, false);
    }

    /* ---------------------
     | City and Territory
     ---------------------*/
     
    public function getCities()
    {
        return DB::table("villes")->get();
    }

    public function getTerritories($id)
    {
        $this->selectedCityId = $id;
        $this->secteurId = null;
        $this->cityTerritories = DB::table("secteurs")
            ->where("ville_id", $id)
            ->get();
            
    }

    public function setSecteurId($id)
    {
        $this->secteurId = $id;
        // $this->checkContinue();
        
        $secteur = DB::table("secteurs")->find($id);
        
    }

    /* ---------------------
     | Dynamic Fields
     ---------------------*/
    public function getFields()
    {
        if ($this->step == 2) {
            return DB::table("champs_cats")
                ->where("categorie_id", $this->selectedCategoryId)
                ->get();
        }

        return collect();
    }

    public function getOptions($id)
    {
        return DB::table("option_champs")
        ->where("champs_cat_id", $id)
            ->get();
    }

    public function setFieldValue($id, $value)
    {
        $this->fieldsValues[$id] = $value;
        // $this->checkContinue();
    }


    public function checkSelectedOption($id, $value)
    {
        return isset($this->fieldsValues[$id]) && $this->fieldsValues[$id] == $value;
    }

    /* ---------------------
     | Fixed Info Handling
     ---------------------*/
    public function setInfo($name, $val)
    {
        if ($name === "price") $this->price = $val;
        if ($name === "title") $this->title = $val;
        if ($name === "description") $this->description = $val;
        // $this->checkContinue();
    }


        
    public function store()
    {
        DB::beginTransaction();
    
        try {
            // 1. Save the annonce
            $annonce = Announce::create([
                'secteur_id' => $this->secteurId,
                'categorie_id' => $this->selectedCategoryId,
                'user_id' => Auth::id(),
                'tel' => Auth::user()->tel, // Assuming you want to use the authenticated user's phone
                // 'addresse' => Auth::user()->address, // Assuming you want to use the authenticated user's address
                'prix' => $this->price,
                'titre_annonce' => $this->title,
                'texte_annonce' => $this->description,
            ]);
            // dd($annonce);
    
            // 2. Save dynamic fields (valeurs_champs)
            foreach ($this->fieldsValues as $champsCatId => $valeur) {
                ValeursChamp::create([
                    'announce_id' => $annonce->id,
                    'champs_cat_id' => $champsCatId,
                    'valeur' => $valeur,
                ]);
            }
    
            // 3. Save images
            if ($this->images && !$this->skipImages) {
                foreach ($this->images as $image) {
                    $filename = Str::slug($this->title) . '-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('annonces', $filename, 'public');
    
                    AnnounceImage::create([
                        'announce_id' => $annonce->id,
                        'chemin' => $path,
                    ]);
                }
            }
    
            DB::commit();
    
            // Optionally reset form fields here
            $this->reset();
    
            $this->dispatch('annonce-created'); 
            return redirect()->route('annonces.index'); // or wherever you want to redirect
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('annonce-creation-failed', message: $e->getMessage());
            return back()->withError('An error occurred: '.$e->getMessage());
        }
    }


public function goNext()
{
    // Validate current step before proceeding
    if (!$this->validateCurrentStep()) {
        return;
    }

    $this->step += 1;
    // $this->ableToGoNext = false;
    
    // if ($this->step == 3) {
    //     // $this->skipImages = false;
    // }
}

public function goBackStep()
{
    $this->step -= 1;
    // $this->ableToGoNext = true;
}

public function confirmSkipImages()
{
    // dd("Confirm skip images method called");
    $this->dispatch('confirm-skip', 
    message: 'Êtes-vous sûr de ne pas vouloir ajouter des images ? Les annonces avec images ont beaucoup plus de visibilité.'
);
}

protected function validateCurrentStep()
{
    if ($this->step == 1) {
        $this->validate([
            'selectedCategoryId' => 'required|exists:categories,id',
            'secteurId' => 'required|exists:secteurs,id',
        ], [
            'selectedCategoryId.required' => 'Veuillez sélectionner une catégorie',
            'secteurId.required' => 'Veuillez sélectionner un secteur',
        ]);
        
        return true;
    }
    
    if ($this->step == 2) {
        // Validate dynamic fields
        foreach ($this->getFields() as $field) {
            if (!isset($this->fieldsValues[$field->id]) || $this->fieldsValues[$field->id] === '') {
                $this->addError('fieldsValues.'.$field->id, 'Ce champ est obligatoire');
                
                return false;
            }
        }
        
        // Validate fixed fields
        $this->validate([
            'price' => 'required|numeric|min:0',
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
        ], [
            'price.required' => 'Le prix est obligatoire',
            'title.required' => 'Le titre est obligatoire',
            'description.required' => 'La description est obligatoire',
        ]);
        
        return true;
    }

    if ($this->step == 3) {
        // dd('Step 3');
    if ( empty($this->images) && !$this->skipImages ) {
        // dd('No images and skipImages is false');
        $this->confirmSkipImages();
        return false;
    }
    return true;
    }
    
    return true;
}


#[On("skip-images-confirmed")]
public function skipImages()
{
    $this->skipImages = true;
    $this->publish();
}

    public function publish()
    {
        // dd("Publish method called");
        if (!$this->validateCurrentStep()) {
            return;
        }

        $this->store();
        
        return redirect()->to('/');
    }

    /* ---------------------
     | Render View
     ---------------------*/
    public function render()
    {
        return view('livewire.add-annonce');
    }
}