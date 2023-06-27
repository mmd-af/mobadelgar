<?php

namespace App\Repositories\Site;

use App\Models\Category\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->setModel($model);
    }

    public function getCategories()
    {
        return $this->query()
            ->select([
                'id',
                'title',
                'slug',
                'description',
                'meta_title',
                'meta_description'

            ])
            ->with(['children','images'])
            ->sorted()
            ->get();
    }
}
