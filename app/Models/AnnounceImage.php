<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnounceImage extends Model
{
    /** @use HasFactory<\Database\Factories\AnnounceImageFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
