<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class Category extends Model
{
    use HasFactory,
        SoftDeletes,
        CategoryRelationships,
        CategoryModifiers,
        hasSlug;

    protected $table = 'categories';
}
