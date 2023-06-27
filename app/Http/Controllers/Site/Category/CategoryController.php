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
//
//    public function index()
//    {
//        $categories = $this->categoryRepository->getAll();
//        return view('admin.categories.index', compact('categories'));
//    }

}
