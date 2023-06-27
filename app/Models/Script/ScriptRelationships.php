<?php

namespace App\Models\Script;

trait ScriptRelationships
{
    public function scriptable()
    {
        return $this->morphTo();
    }

}
