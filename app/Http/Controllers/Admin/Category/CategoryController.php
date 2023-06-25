<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Models\Category\Category;
use App\Repositories\Admin\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.categories.index', compact('categories'));
    }

    public function show($category)
    {
        $category = $this->categoryRepository->getCategory($category);
        $childCategory = $this->categoryRepository->getCategoryByParent($category->id);
        return view('admin.categories.show', compact('category','childCategory'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->categoryRepository->store($request);
        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->categoryRepository->update($request, $category);
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->categoryRepository->destroy($category);
        return redirect()->route('admin.categories.index');
    }
}
