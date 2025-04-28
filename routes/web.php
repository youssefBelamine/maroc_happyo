<?php

use App\Models\Categorie;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

// php artisan make:model GrandCat -a
// php artisan make:model ParentCat -a
// php artisan make:model EnfantCat -a
// php artisan make:model ChampsCat -a
// php artisan make:model ValeursChamp -a
// php artisan make:model OptionChamp -a
// php artisan make:model Ville -a
// php artisan make:model Secteur -a
// php artisan make:model Announce -a
// php artisan make:model AnnounceImage -a
// php artisan make:model Favori -a

// php artisan make:model Categorie -a

Route::get('/test', function () {
    // $step = 5000;
    // for ($i = 0; $i <= 450000; $i += $step){
    //     if ($i >= 100000 ){$step = 10000;}
    //     if ($i >= 200000 ){$step = 50000;}
    //     $i == 450000 ? dump("Plus de ".($i+$step)) : dump("$i - " . ($i + $step -1));
    // }
    // for ($year = (int) date("Y"); $year > 1980; --$year){
    //     dump($year);
    // }
    // dd(($year)." ou plus ancien");
    // $Puissance_fiscales = [];
        // for ($i=4; $i<=41; $i++) {
        //     $Puissance_fiscales[] = $i===41 ? "Plus de $i CV" : "$i CV";
        // }
        // dd($Puissance_fiscales);
        // dd(Str::snake('Hauteur de selle'));

        $arbre_categories = [
            "Market" => [
                "Tech et Multimédia" => ["Téléphone", "Ordinateurs portables"],
                "Maison et Jardin" => ["Electroménager", "Décoration"],
                "Santé & Sport" => ["Equipement Sportif", "Complément Alimentaires"]
            ],
            "Véhicules" => [
                "Voitures" , "Motos", "Vélos"
            ],
            "Immobilier"=> [
                "Appartement", "Maison"
            ]
        ];
        $categories = Categorie::all();



        // foreach ($categories as $c){
            // dump($c->id." | ".$c->name." | ".($c->parent_id ? $c->parent_id : "null"));
            // foreach ($c->children as $child){
            //     dump("------->> ".$child->name);
            // }
            $roots = Categorie::with('children.children')
                ->whereNull('parent_id')
                ->get();

    $arbre = [];

    foreach ($roots as $root) {
        // for each top-level category (Market, Véhicules, Immobilier)
        $branch = [];

        foreach ($root->children as $lvl2) {
            if ($lvl2->children->isEmpty()) {
                // case “Véhicules” and “Immobilier”: level-2 are leaves
                $branch[] = $lvl2->name;
            } else {
                // case “Market”: level-2 has its own children
                $branch[$lvl2->name] = $lvl2->children->pluck('name')->toArray();
            }
        }

        $arbre[$root->name] = $branch;
    }

    dd($arbre);
        
        // null ? dd("ok") : dd("no");
});