<?php

namespace App\Repositories\Admin;

use App\Models\Category\Category;
use App\Models\Faq\Faq;
use App\Models\Image\Image;
use App\Models\Script\Script;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'slug',
                'is_active'

            ])
            ->where('parent_id', 0)
            ->sorted()
            ->get();

    }

    public function getCategory($category)
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'description',
                'meta_title',
                'meta_description'

            ])
            ->where('id', $category)
            ->with(['children','images'])
            ->first();

    }

    public function getCategoryById($request)
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'slug',
                'parent_id',
                'is_active'
            ])
            ->where('id', $request->categoryID)
            ->with('images')
            ->first();
    }

    public function store($request)
    {

        $item = new Category();
        $item->title = $request->input('title');
        $item->slug = str_slug_persian($request->input('slug'));
        $item->type = $request->input('cat_type');
        $item->description = $request->input('description');
        if ($request->child_id) {
            $item->parent_id = $request->input('child_id');
        } else {
            $item->parent_id = $request->input('parent_id');
        }
        $item->image = "noset";
        $item->meta_title = $request->input('meta_title');
        $item->meta_description = $request->input('meta_description');
        $item->is_active = $request->input('is_active');
        $item->save();
        $image = new Image();
        $image->url = $request->input('url');
        $item->images()->save($image);
        return $item;
    }

    public function updateCategory($request)
    {
        $category = $this->getCategoryById($request);
        $category->title = $request->input('title');
        if ($request->child_id) {
            $category->parent_id = $request->input('child_id');
        } else {
            $category->parent_id = $request->input('parent_id');
        }
        $category->is_active = $request->input('is_active');
        $category->save();
        $category->images()->update(['url' => $request->input('url')]);
        return $category;
    }

    public function updateContentCategory($request)
    {
        $category = $this->getCategoryById($request);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->save();
    }

    public function categoryScriptStore($request)
    {
        $category = $this->getCategoryById($request);
        $category->scripts()->updateOrCreate(
            ['scriptable_id' => $category->id], // شرط بر اساس آن رکورد بروزرسانی یا ایجاد می‌شود
            [
                'css' => $request->css,
                'html' => $request->html,
                'js' => $request->js,
            ]
        );
    }

    public function storeFaqCategory($request)
    {
        $category = $this->getCategoryById($request);
        $count = count($request->faq_questions);
        for ($i = 0; $i < $count; $i++) {
            $faq = new Faq();
            $faq->question = $request['faq_questions'][$i];
            $faq->answer = $request['faq_answers'][$i];
            $category->faqs()->save($faq);
        }
    }

    public function changeCategoryPosition($request)
    {
        $entity = $this->model->find($request->entityId);
        $positionEntity = $this->model->find($request->positionEntityId);
        $entity->moveAfter($positionEntity);
    }

//    public function categorizablesDestroy($category)
//    {
//        DB::table('categorizables')->where('category_id', $category->id)->delete();
//
//    }

    public function destroy($category)
    {
//        foreach ($category->children as $child) {
//            $this->categorizablesDestroy($child);
//            $child->images()->delete();
//            $child->delete();
//        }
//        $this->categorizablesDestroy($category);
        $category->images()->delete();
        $category->delete();
//        alert()->success('دسته ی مورد نظر با موفقیت پاک شد', 'باتشکر');
    }
}
