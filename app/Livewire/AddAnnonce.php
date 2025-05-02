<?php

namespace App\Livewire;

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddAnnonce extends Component
{
    // Public properties for the form state
    public $continue = false;
    public $step = 2;

    // Categories
    public $children = [];
    public $currentId = null;
    public $parent = "";
    public $selectedCategoryId = 7;

    // Cities and territories
    public $selectedCityId = null;
    public $cityTerritories = [];
    public $secteurId = null;

    public $fieldsValues = [];

    /**
     * Lifecycle hook on component mount.
     */
    public function mount()
    {
        $this->getCategories();
        $this->getCities();
    }

    public function setFieldValue($id, $value){
        $this->fieldsValues[$id] = $value;
        dump($this->fieldsValues);
    }

    public function checkContinue() {
        if ($this->selectedCategoryId && $this->secteurId && $this->step == 1){
            // dd("ok");
            return true;

        }
        return false;
    }

    public function goNext() {
        // dd($this->step);
        $this->checkContinue() ? $this->step += 1 : "";
        $this->getFields();
    }

    public function goBackStep(){
        $this->step -= 1;
    }

    /**
     * Fetch root categories with nested children.
     */
    public function getCategories()
    {
        return Categorie::with('children.children')
            ->whereNull('parent_id')
            ->get();
    }

    /**
     * Reset category children and selection.
     */

    public function resetChildren()
    {
        $this->children = [];
        $this->parent = "";
        $this->currentId = null;
        $this->selectedCategoryId = null;
        $this->continue = false;
    }

    /**
     * Check if a category has children.
     */
    public function hasChildren($id)
    {
        return DB::table("categories")
            ->where("parent_id", $id)
            ->exists();
    }

    /**
     * Get child categories or select final category.
     */
    public function getChildren($id, $parent = "", $goBack = false)
    {
        if ($this->hasChildren($id)) {
            $this->currentId = $goBack ? $id : null;
            $this->parent = $parent;
            $this->children = DB::table("categories")
                ->where("parent_id", $id)
                ->get();

            $this->selectedCategoryId = null;
            $this->continue = false;
        } else {
            $this->selectedCategoryId = $id;
            // $this->continue = true;
        }

        $this->checkContinue();

    }

    /**
     * Go back to the parent category level.
     */
    public function goBack()
    {    
        $currentCat = DB::table("categories")->find($this->currentId);
        $previousCat = DB::table("categories")->find($currentCat->parent_id);

        $this->getChildren($previousCat->id, $previousCat->name, false);
    }

    /**
     * Load cities from DB.
     */
    public function getCities()
    {
        return DB::table("villes")->get();
    }

    /**
     * Load city territories based on selected city.
     */
    public function getTerritories($id)
    {   
        $this->selectedCityId = $id;
        $this->secteurId = null;
        $this->cityTerritories = DB::table("secteurs")
            ->where("ville_id", $id)
            ->get();
    }

    public function setSecteurId($id) {
        $this->secteurId = $id;
        $this->checkContinue();
    }

    public function getFields(){
        if ($this->step == 2){
            $fields = DB::table("champs_cats")
            ->where("categorie_id", $this->selectedCategoryId)
            ->get();
            return $fields;
        }
    }

    public function getOptions($id){
        return DB::table("option_champs")
        ->where("champs_cat_id", $id)
        ->get();
    }

    public function getFieldValue($id, $value){

    }

    /**
     * Render the Livewire view.
     */
    public function render()
    {
        return view('livewire.add-annonce');
    }
}
