<?php

namespace App\Models\Post;

use App\Models\Faq\Faq;
use App\Models\Image\Image;
use App\Models\Insidelink\Insidelink;
use App\Models\Note\Note;
use App\Models\Schema\Schema;
use App\Models\Script\Script;

trait PostRelationships
{

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scripts()
    {
        return $this->morphOne(Script::class, 'scriptable');
    }

    public function insidelinks()
    {
        return $this->morphOne(Insidelink::class, 'insidelinkable');
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
}
