<?php

namespace App\Models\Post;

use Spatie\Sluggable\SlugOptions;

trait PostModifiers
{
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('slug')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

//    public function getTypeAttribute($type)
//    {
//        if ($type == EPostType::COURSE) {
//            return 'دوره های آموزشی ';
//        } elseif ($type == EPostType::BLOG) {
//            return 'وبلاگ';
//        } elseif ($type == EPostType::SHOP) {
//            return 'فروشگاه';
//        } elseif ($type == EPostType::INSTRUMNET) {
//            return 'ساز ها';
//        }
//    }
}
