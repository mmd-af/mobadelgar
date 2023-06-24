<?php

namespace App\Models\Category;

use App\Models\Blog\Blog;
use App\Models\Image\Image;
use App\Models\PrivateCourse\PrivateCourse;
use App\Models\Product\Product;
use App\Models\VideoCourse\VideoCourse;

trait CategoryRelationships
{
    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'categorizable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'categorizable');
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function videoCourses()
    {
        return $this->morphedByMany(VideoCourse::class, 'categorizable');
    }

    public function privateCourses()
    {
        return $this->morphedByMany(PrivateCourse::class, 'categorizable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}