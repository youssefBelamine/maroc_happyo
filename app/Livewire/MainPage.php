<?php

namespace App\Livewire;

use App\Models\Announce;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class MainPage extends Component
{
    public $Categories = [];
    public $children = [];
    public $currentId = null;
    public $catId = null;
    public $parent = "";
    // PUBLIC $IDs_category_and_children = [];
    public $annonces = [];


    public function getCategories(){
        $roots = Categorie::with('children.children')
                ->whereNull('parent_id')
                ->get();
        $this->Categories = $roots;
    }

    public function resetChildren() {
        $this->catId = null;
        $this->children = [];
        $this->parent = "";
        $this->currentId = null;
        $this->getAnnonces([], true); // Show all annonces
    }
    

    
    public function goBack() {

        $currentCat = DB::table("categories")
        ->where("id", $this->currentId)
        ->get();

        $previousCat = DB::table("categories")
        ->where("id", $currentCat[0]->parent_id)
        ->get();
        $this->getChildren($previousCat[0]->id, $previousCat[0]->name, false);
    }

    public function hasChildren($id) {
        $hasChildren = DB::table("categories")
            ->where("parent_id", $id)
            ->exists();
        return $hasChildren;
    }

    public function getChildren($id, $parent = "", $goBack = false, $fillArray = true) {
        // dd('here');
        $this->catId = $id;
        if($this->hasChildren($id)){
            $goBack ? $this->currentId = $id : $this->currentId = null;
            $this->parent = $parent;
            if ($fillArray){
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
        // dump("ok");
        return ;
    }


    public function getAnnonces($IDs = [], $all = false) {
        if ($all || empty($IDs)) {
            $this->annonces = Announce::latest()->get();
        } else {
            $this->annonces = Announce::whereIn('categorie_id', $IDs)->latest()->get();
        }
    }

    public function getLeafChildrenIds($id)
{
    $result = [];

    $fetchLeafChildren = function($parentId) use (&$result, &$fetchLeafChildren) {

        foreach ($this->getChildren($parentId, "", false, false) as $child) {

            if ($this->hasChildren($child->id)) {
                // Recurse deeper if it has children
                $fetchLeafChildren($child->id);
            } else {
                // It’s a leaf node
                $result[] = $child->id;
            }
        }
    };

    $fetchLeafChildren($id);

    return $result;

}

public function mount()
    {
        $this->getAnnonces([], true);
    }

    public function render()
    {
        $this->getCategories();
        return view('livewire.main-page');
    }
}
