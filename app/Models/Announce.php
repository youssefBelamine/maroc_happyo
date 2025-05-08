<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;


class Announce extends Model
{
    /** @use HasFactory<\Database\Factories\AnnounceFactory> */
    use HasFactory;
    protected $guarded = ["id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AnnounceImage::class);
    }

    public function valuesOfFields(): HasMany
    {
        return $this->hasMany(ValeursChamp::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Secteur::class, 'secteur_id');
    }

    public function getDaysSinceCreatedAttribute(): int
{
    return Carbon::parse($this->created_at)->diffInDays(now());
}

}
