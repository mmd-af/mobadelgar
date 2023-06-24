<?php

namespace App\Repositories\Admin;

use App\Models\Category\Category;
use App\Models\Image\Image;
use Illuminate\Support\Facades\DB;

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
                'parent_id',
                'type'
            ])->get();

    }

    public function getLatest()
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'slug',
                'type',
                'parent_id',
                'is_active'

            ])
            ->latest()
            ->paginate(10);

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

    public function getCategoryByType($type)
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'slug',
                'parent_id',
                'type'
            ])
            ->where('type', $type)
            ->where('parent_id', 0)
            ->get();
    }

    public function getCategoryByParent($type)
    {
        return Category::query()
            ->select([
                'id',
                'title',
                'slug',
                'parent_id',
                'type'
            ])
            ->where('parent_id', $type)
            ->get();
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
//        alert()->success('دسته ی مورد نظر با موفقیت ایجاد شد', 'باتشکر');
        return $item;
    }

    public function updateCategory($request)
    {
        $category= $this->getCategoryById($request);
        $category->title = $request->input('title');
//        $category->type = $request->input('cat_type');
//        $category->description = $request->input('description');
        if ($request->child_id) {
            $category->parent_id = $request->input('child_id');
        } else {
            $category->parent_id = $request->input('parent_id');
        }
//        $category->meta_title = $request->input('meta_title');
//        $category->meta_description = $request->input('meta_description');
        $category->is_active = $request->input('is_active');
        $category->save();
        $category->images()->update(['url' => $request->input('url')]);
//        alert()->success('دسته ی مورد نظر با موفقیت ویرایش شد', 'باتشکر');
        return $category;
    }

    public function categorizablesDestroy($category)
    {
        DB::table('categorizables')->where('category_id', $category->id)->delete();

    }

    public function destroy($category)
    {
        foreach ($category->children as $child) {
            $this->categorizablesDestroy($child);
            $child->images()->delete();
            $child->delete();
        }
        $this->categorizablesDestroy($category);
        $category->images()->delete();
        $category->delete();
        alert()->success('دسته ی مورد نظر با موفقیت پاک شد', 'باتشکر');
    }
}
