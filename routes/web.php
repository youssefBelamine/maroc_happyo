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


Route::get("test", function (){
    dd("1");
    dd("2");
});
Route::get("cat", function (){
    $result = [];

    $fetchLeafChildren = function($parentId) use (&$result, &$fetchLeafChildren) {
        $children = DB::table('categories')->where('parent_id', $parentId)->get();

        foreach ($children as $child) {
            $hasChildren = DB::table('categories')->where('parent_id', $child->id)->exists();

            if ($hasChildren) {
                // Recurse deeper if it has children
                $fetchLeafChildren($child->id);
            } else {
                // It’s a leaf node
                $result[] = $child->id;
            }
        }
    };

    $fetchLeafChildren(1);

     dd($result);
    });