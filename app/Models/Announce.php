<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    /** @use HasFactory<\Database\Factories\AnnounceFactory> */
    use HasFactory;
    protected $guarded = ["id"];
}
