<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    /** @use HasFactory<\Database\Factories\SecteurFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
