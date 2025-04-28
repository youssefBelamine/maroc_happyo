<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChampsCat extends Model
{
    /** @use HasFactory<\Database\Factories\ChampsCatFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
