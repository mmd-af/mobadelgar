<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;

class CategoryAjaxController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function categoryType(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->getCategoryByType($request->value)
        ]);
    }

    public function categoryChild(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->getCategoryByParent($request->value)
        ]);
    }
}
