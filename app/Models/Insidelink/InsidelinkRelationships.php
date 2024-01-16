<?php

namespace App\Models\Insidelink;

trait InsidelinkRelationships
{
    public function scriptable()
    {
        return $this->morphTo();
    }

}
