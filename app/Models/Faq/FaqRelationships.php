<?php

namespace App\Models\Faq;

trait FaqRelationships
{
    public function faqable()
    {
        return $this->morphTo();
    }
}
