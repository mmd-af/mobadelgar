<?php

namespace App\Models\Category;

use App\Enums\ECategoryType;
use Spatie\Sluggable\SlugOptions;

trait CategoryModifiers
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

    public function getTypeAttribute($type)
    {
//        if ($type == ECategoryType::COURSE) {
//            return 'دوره های آموزشی ';
//        } elseif ($type == ECategoryType::BLOG) {
//            return 'وبلاگ';
//        } elseif ($type == ECategoryType::SHOP) {
//            return 'فروشگاه';
//        } elseif ($type == ECategoryType::INSTRUMNET) {
//            return 'ساز ها';
//        }
    }
}
