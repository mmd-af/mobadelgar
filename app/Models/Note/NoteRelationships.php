<?php

namespace App\Models\Note;

use App\Models\Category\Category;
use App\Models\User;

trait NoteRelationships
{
    public function noteable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'noteable_id');
    }
}
