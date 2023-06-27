<?php

namespace App\Http\Controllers\Site\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Site\CategoryRepository;

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
        return view('site.categories.show', compact('category'));
    }

}
