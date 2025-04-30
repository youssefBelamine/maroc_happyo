<?php

namespace App\Livewire;

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MainPage extends Component
{
    public $Categories = [];
    public $children = [];
    public $currentId = null;
    public $parent = "";

    public function getCategories(){
        $roots = Categorie::with('children.children')
                ->whereNull('parent_id')
                ->get();
        $this->Categories = $roots;
    }

    public function resetChildren() {
        $this->children = [];
        $this->parent = "";
        $this->currentId = null;
    }

    public function hasChildren($id) {
        $hasChildren = DB::table("categories")
            ->where("parent_id", $id)
            ->exists();
        return $hasChildren;
    }

    public function getChildren($id, $parent = "", $goBack = false){
        if($this->hasChildren($id)){
            $goBack ? $this->currentId = $id : $this->currentId = null;
            $this->parent = $parent;
        $this->children = DB::table("categories")
                    ->where("parent_id", $id)
                    ->get();
        }
        return ;
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

    public function render()
    {
        // $this->getChildren(5);
        // $this->hasChildren(5) ? dd($this->children) : dd("bah");
        $this->getCategories();
        return view('livewire.main-page');
    }
}
