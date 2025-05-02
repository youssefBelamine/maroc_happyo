<?php

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', 'main');
// dump("dashboard route");
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', "admin"])
    ->name('dashboard');

    Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::view('ajouter-annonce', 'annonce')
    ->middleware(['auth'])
    ->name('annonce');

require __DIR__.'/auth.php';


Route::get("test", function (){return view("test");});
Route::get("cat", function (){
    // $roots = Categorie::with('children.children')
    // ->whereNull('parent_id')
    // ->get();
    // foreach ($roots as $root){
    //      dump($root->name);
    //     }
    // dd(null ? "manalchay" : "raha null");
    // $previousCat = DB::table("categories")
    //     ->where("id", 4)
    //     ->get();

    //     dd($previousCat[0]->id);
    $x = [];
    $x[1] = "one";
    $x[2] = "two";
    $x[3] = "three";
    dd($x);
    });