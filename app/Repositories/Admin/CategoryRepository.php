<?php

namespace App\Repositories\Admin;

use App\Models\Category\Category;
use App\Models\Faq\Faq;
use App\Models\Image\Image;
use App\Models\Note\Note;
use App\Models\Schema\Schema;
use App\Models\Script\Script;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Class_;

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
            ->with(['children', 'images'])
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
        if ($request->json_ld) {
            $schema = new Schema();
            $schema->json_ld = $request->json_ld;
            $category->schemas()->updateOrCreate([], ['json_ld' => $request->json_ld]);
        }
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

    public function categoryInsidelinkStore($request)
    {
        $category = $this->getCategoryById($request);
        $category->insidelinks()->updateOrCreate(
            ['insidelinkable_id' => $category->id], // شرط بر اساس آن رکورد بروزرسانی یا ایجاد می‌شود
            [
                'html' => $request->html
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

    public function showAllNote()
    {

        return Note::query()
            ->select([
                'id',
                'user_id',
                'description',
                'noteable_id',
                'created_at'
            ])
            ->where('noteable_type', Category::class)
            ->with(['users', 'category'])
            ->get();

    }

    public function showNote($request)
    {
        $category = $this->model->find($request->id);
        return $category->notes()->with('users')->get();

    }

    public function noteStore($request)
    {
        $user_id = Auth::id();
        $note = new Note();
        $note->user_id = $user_id;
        $note->description = $request->description;
        $note->noteable_id = $request->id;
        $note->noteable_type = Category::class;
        $note->save();
    }

    public function destroy($category)
    {
        foreach ($category->children as $imCategory) {
            $imCategory->images()->delete();
        }
        $category->children()->delete();
        $category->images()->delete();
        $category->delete();
    }
}
