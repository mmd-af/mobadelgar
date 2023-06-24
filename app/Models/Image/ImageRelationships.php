<?php

namespace App\Models\Image;

trait ImageRelationships
{
    public function imageable()
    {
        return $this->morphTo();
    }

}
