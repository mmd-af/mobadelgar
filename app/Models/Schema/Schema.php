<?php

namespace App\Models\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schema extends Model
{
    use HasFactory,
        SoftDeletes,
        SchemaRelationships,
        SchemaModifiers;

    protected $table = 'schemas';
    protected $fillable = ['json_ld'];

}
