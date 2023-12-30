<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,
        SoftDeletes,
        CommentRelationships,
        CommentModifiers;

    protected $table = 'comments';
}
