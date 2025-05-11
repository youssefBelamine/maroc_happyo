<?php

namespace App\Livewire;

use App\Models\Announce;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class MainPage extends Component
{
    public $Categories = [];
    public $children = [];
    public $currentId = null;
    public $catId = null;
    public $parent = "";
    public $IDs_category_and_children = [];
    public $annonces = [];
    public $mainCat = null;


    public function getCategories()
    {
        $roots = Categorie::with('children.children')
            ->whereNull('parent_id')
            ->get();
        $this->Categories = $roots;
    }

    public function resetChildren()
    {
        $this->catId = null;
        $this->children = [];
        $this->parent = "";
        $this->currentId = null;
        $this->getAnnonces([], true); // Show all annonces
        $this->getAnnonces();
    }



    public function goBack()
    {

        $currentCat = DB::table("categories")
            ->where("id", $this->currentId)
            ->get();

        $previousCat = DB::table("categories")
            ->where("id", $currentCat[0]->parent_id)
            ->get();
        $this->getChildren($previousCat[0]->id, $previousCat[0]->name);
    }

    public function hasChildren($id)
    {
        $hasChildren = DB::table("categories")
            ->where("parent_id", $id)
            ->exists();
        return $hasChildren;
    }

    public function hasParent($id)
    {   
        // dd($id);
        return DB::table("categories")
            ->where("id", $id)
            ->whereNotNull("parent_id")
            ->exists();
    }

    public function checkMain($id) {
        return DB::table("categories")
            ->where("id", $id)
            ->whereNull('parent_id')
            ->exists();
    }

    public function getChildren($id, $parent = "", $fillArray = true)
    {
        $this->checkMain($id) ? $this->mainCat = $id : $this->mainCat = $this->mainCat;
        
        if ($this->hasParent($id) && $fillArray || !$this->hasChildren($id)) {
            
            $this->currentId = $id;
            
        } else {
            
            $this->currentId = null;
            
        }

        // dd($id);
        $this->catId = $id;

        if ($this->hasChildren($id)) {

            $this->parent = $parent;

            if ($fillArray) {

                // dd("ok");

                $this->children = DB::table("categories")

                    ->where("parent_id", $id)

                    ->get();

            } else {
                return DB::table("categories")
                    ->where("parent_id", $id)
                    ->get();
            }
        }

        $this->getAnnonces($this->getLeafChildrenIds($id));

        // $this->IDs_category_and_children = $this->getLeafChildrenIds($id);
        // dump("ok");
        return;
    }


    public function getAnnonces($IDs = [])
    {
        $this->annonces = [];
        if ($this->catId == null) {
            $this->annonces = Announce::all();
        } else if ($IDs) {
            foreach ($IDs as $id) {
                $AnnonceOfCategory = Announce::where('categorie_id', $id)->get();
                foreach ($AnnonceOfCategory as $annonce) {
                    $this->annonces[] = $annonce;
                }
            }
        }
        // foreach ($this->annonces as $annonce) {
        //     dump($annonce);
        // }
        // dd("ok");
    }


    public function getLeafChildrenIds($id)
    {
        $result = [];

        $fetchLeafChildren = function ($parentId) use (&$result, &$fetchLeafChildren) {

            if (!$this->hasChildren($parentId)) {
                // If it has children, we need to recurse
                $result[] = $parentId; // Add the parent ID to the result
                return;
            }

            $childrenIDs = DB::table("categories")

            ->where("parent_id", $parentId)->select("id")

            ->get();

            foreach ($childrenIDs as $childID) {
                
                if ($this->hasChildren($childID->id)) {

                    // Recurse deeper if it has children

                    $fetchLeafChildren($childID->id);
                } else {

                    // It’s a leaf node

                    $result[] = $childID->id;
                }
            }
        };

        $fetchLeafChildren($id);

        return $result;
    }

    public function getValuesOfAnnonce($annonce_id, $annonce_cat_id)
    {
        $values = [];
        $fields = [];
        $fields = DB::table("champs_cats")->where("categorie_id", $annonce_cat_id)->get();
        // $values_of_annonce = DB::table("valeurs_annonces")
        foreach ($fields as $field) {
            $value_of_field = DB::table("valeurs_champs")->where("champs_cat_id", $field->id)
                ->where("annonce_id", $annonce_id)->get();
            $values[$field->nom] = $value_of_field[0]->valeur;
        }

        return $values;
        // ->where("nom", $name)

    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    }

    public function mount()
    {
        $this->getAnnonces([]);
    }

    public function render()
    {
        $this->getCategories();
        return view('livewire.main-page');
    }
}
