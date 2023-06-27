<?php

namespace App\Repositories\Admin;

use App\Models\Faq\Faq;

class FaqRepository extends BaseRepository
{
    public function __construct(Faq $model)
    {
        $this->setModel($model);
    }

    public function destroy($faq)
    {
        $faq = $this->find($faq);
        $faq->delete();
    }
}
