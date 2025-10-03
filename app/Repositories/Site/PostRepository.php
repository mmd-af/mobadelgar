<?php

namespace App\Repositories\Site;

use App\Models\Post\Post;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        $this->setModel($model);
    }

    public function getPosts()
    {
        return $this->query()
            ->select([
                'id',
                'title',
                'slug'
            ])
            ->where('is_active', 1)
            ->with(['images'])
            ->get();
    }

    public function getAllPosts()
    {
        return $this->query()
            ->select([
                'id',
                'title',
                'slug',
                'meta_description'
            ])
            ->where('is_active', 1)
            ->with(['images'])
            ->get();
    }

    public function getPostBySlug($post)
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
            ->where('slug', $post)
            ->where('is_active', 1)
            ->with(['images', 'scripts', 'faqs', 'schemas'])
            ->first();
    }
}
