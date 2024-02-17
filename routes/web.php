<?php

use App\Models\Category\Category;
use App\Models\Post\Post;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/sitemap', function () {
    $path = base_path('sitemap.xml');
    $categories = Category::query()
        ->select([
            'id',
            'slug',
            'title',
            'updated_at',
            'parent_id',
            'is_active'
        ])
        ->where('is_active', 1)
        ->where('parent_id', 0)
        ->with(['images', 'children'])
        ->get();
    $posts = Post::query()
        ->select([
            'id',
            'slug',
            'title',
            'updated_at',
            'is_active'
        ])
        ->where('is_active', 1)
        ->with(['images'])
        ->get();
    $sitemap = Sitemap::create();
    $sitemap->add(Url::create(url('/'))
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        ->setPriority(1.0));
    foreach ($categories as $category) {
        $sitemap->add(Url::create(route('site.categories.show', $category->slug))
            ->setLastModificationDate($category->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0)
            ->addImage($category->images->url, $category->title)
        );
        foreach ($category->children as $children) {
            $sitemap->add(Url::create(route('site.categories.child', [$category->slug, $children->slug]))
                ->setLastModificationDate($children->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(1.0)
                ->addImage($children->images->url, $children->title)
            );
        }
    }
    foreach ($posts as $post) {
        $sitemap->add(Url::create(route('site.posts.show', $post->slug))
            ->setLastModificationDate($post->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0)
            ->addImage($post->images->url, $post->title)
        );
    }
    $sitemap->writeToFile($path);
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/sitemap.xml', function () {
    $path = base_path('sitemap.xml');
    return response()->file($path);
});

Route::get('/script-test', function () {
    return view('site.categories.script-test');
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return Artisan::output();
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return Artisan::output();
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/storage', function () {
    Artisan::call('storage:link');
    return Artisan::output();
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/public/{path}', function ($path) {
    return redirect(url($path));
})->where('path', '.*');
