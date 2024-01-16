<?php

namespace App\Models\Insidelink;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insidelink extends Model
{
    use HasFactory,
        SoftDeletes,
        InsidelinkRelationships,
        InsidelinkModifiers;

    protected $table = 'insidelinks';
    protected $fillable = ['html'];
}
