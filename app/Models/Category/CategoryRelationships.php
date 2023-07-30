<?php

namespace App\Models\Category;

use App\Models\Faq\Faq;
use App\Models\Image\Image;
use App\Models\Note\Note;
use App\Models\Schema\Schema;
use App\Models\Script\Script;

trait CategoryRelationships
{

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scripts()
    {
        return $this->morphOne(Script::class, 'scriptable');
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function schemas()
    {
        return $this->morphOne(Schema::class, 'schemaable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
