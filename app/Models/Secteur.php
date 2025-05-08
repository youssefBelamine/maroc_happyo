<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Secteur extends Model
{
    /** @use HasFactory<\Database\Factories\SecteurFactory> */
    use HasFactory;
    protected $guarded = ["id"];

    public function city(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

}
