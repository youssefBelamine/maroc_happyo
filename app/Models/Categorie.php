<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    protected $guarded = ["id"];
    use HasFactory;

    public function parent()
{
    return $this->belongsTo(Categorie::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(Categorie::class, 'parent_id');
}

}
