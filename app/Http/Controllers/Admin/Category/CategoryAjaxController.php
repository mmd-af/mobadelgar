<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;

class CategoryAjaxController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function changeCategoryPosition(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->changeCategoryPosition($request)
        ]);
    }

    public function getCategory(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->getCategoryById($request)
        ]);
    }

    public function updateCategory(CategoryUpdateRequest $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->updateCategory($request)
        ]);
    }

    public function updateContentCategory(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->updateContentCategory($request)
        ]);
    }

    public function categoryScriptStore(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->categoryScriptStore($request)
        ]);
    }

    public function categoryInsidelinkStore(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->categoryInsidelinkStore($request)
        ]);
    }

    public function storeFaqCategory(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->storeFaqCategory($request)
        ]);
    }

    public function showAllNote(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->showAllNote()
        ]);
    }
    public function showNote(Request $request)
    {
        return response()->json([
            'data' => $this->categoryRepository->showNote($request)
        ]);
    }

//    public function categoryType(Request $request)
//    {
//        return response()->json([
//            'data' => $this->categoryRepository->getCategoryByType($request->value)
//        ]);
//    }

//    public function categoryChild(Request $request)
//    {
//        return response()->json([
//            'data' => $this->categoryRepository->getCategoryByParent($request->value)
//        ]);
//    }
}
