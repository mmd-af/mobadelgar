<?php

namespace App\Http\Controllers\Site\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Site\CategoryRepository;
use Illuminate\Http\Request;

class CategoryAjaxController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->getCategories($request)
        ]);
    }
    public function getAllCategories(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->getAllCategories()
        ]);
    }
}
