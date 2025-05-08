<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValeursChamp extends Model
{
    /** @use HasFactory<\Database\Factories\ValeursChampFactory> */
    use HasFactory;
    protected $guarded = ["id"];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ChampsCat::class, 'categorie_id');
    }

}
