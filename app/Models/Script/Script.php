<?php

namespace App\Models\Script;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Script extends Model
{
    use HasFactory,
        SoftDeletes,
        ScriptRelationships,
        ScriptModifiers;

    protected $table = 'scripts';
    protected $fillable = ['css', 'html', 'js'];
}
