<?php

namespace App\Http\Controllers\Site\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Site\CategoryRepository;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function show($category)
    {
        $category = $this->categoryRepository->getCategoryBySlug($category);
        SEOMeta::setTitle($category->meta_title);
        SEOMeta::setDescription($category->meta_description);
        OpenGraph::setTitle($category->meta_title);
        OpenGraph::setDescription($category->meta_description);
        OpenGraph::setUrl(route('site.categories.show', $category->slug));
        OpenGraph::addImage($category->images->url, ['height' => 200, 'width' => 200]);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName("مبدل گر");
        return view('site.categories.show', compact('category'));
    }

    public function child($category, $child)
    {
        $parentSlugCategory = $category;
        $category = $this->categoryRepository->getCategoryBySlug($child);
        SEOMeta::setTitle($category->meta_title);
        SEOMeta::setDescription($category->meta_description);
        OpenGraph::setTitle($category->meta_title);
        OpenGraph::setDescription($category->meta_description);
        OpenGraph::setUrl(route('site.categories.child', ['category' => $parentSlugCategory, 'slug' => $category->slug]));
        OpenGraph::addImage($category->images->url, ['height' => 200, 'width' => 200]);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName("مبدل گر");
        return view('site.categories.child', compact('category'));
    }

}
