<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class Post extends Model
{
    use HasFactory,
        SoftDeletes,
        PostRelationships,
        PostModifiers,
        hasSlug;

    protected $table = 'posts';
}
