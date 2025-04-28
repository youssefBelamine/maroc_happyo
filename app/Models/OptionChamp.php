<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionChamp extends Model
{
    /** @use HasFactory<\Database\Factories\OptionChampFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
