<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValeursChamp extends Model
{
    /** @use HasFactory<\Database\Factories\ValeursChampFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
