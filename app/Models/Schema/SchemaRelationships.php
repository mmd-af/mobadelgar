<?php

namespace App\Models\Schema;

trait SchemaRelationships
{
    public function schemaable()
    {
        return $this->morphTo();
    }
}
