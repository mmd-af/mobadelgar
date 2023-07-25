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
                'slug',
                'parent_id'
            ])
            ->where('is_active', 1)
            ->where('parent_id', $request->parent_id)
            ->with(['images', 'parent'])
            ->sorted()
            ->get();
    }

    public function getAllCategories()
    {
        return $this->query()
            ->select([
                'id',
                'title',
                'slug',
                'meta_description',
                'parent_id'
            ])
            ->where('is_active', 1)
//            ->whereHas('parent', function ($query) {
//                $query->where('is_active', 1);
//            })
            ->with(['parent'])
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
                'meta_description',
                'parent_id'

            ])
            ->where('slug', $category)
            ->where('is_active', 1)
            ->with(['children', 'images', 'scripts', 'faqs', 'schemas', 'parent'])
            ->first();
    }
}
