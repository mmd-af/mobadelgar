<?php

namespace App\Repositories\Site;

use App\Models\Category\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->setModel($model);
    }

    public function getCategories($request)
    {
        return $this->query()
            ->select([
                'id',
                'title',
                'slug'
            ])
            ->where('is_active', 1)
            ->where('parent_id', $request->parent_id)
            ->with(['images'])
            ->sorted()
            ->get();
    }

    public function getCategoryBySlug($category)
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
            ->where('slug', $category)
            ->where('is_active', 1)
            ->with(['children', 'images', 'scripts', 'faqs'])
            ->first();
    }
}
