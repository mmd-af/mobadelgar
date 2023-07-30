<?php

namespace App\Repositories\Admin;

use App\Models\Note\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NoteRepository extends BaseRepository
{
    public function __construct(Note $model)
    {
        $this->setModel($model);
    }

    public function destroy($note)
    {
        $note = $this->find($note);
        if ($note->users->id === Auth::id()) {
            $note->delete();
            Session::flash('success', 'یادداشت مورد نظر پاک شد.');
        } else {
            Session::flash('error', 'شما نمی توانید یادداشت های دیگران را حذف کنید!');
        }
    }
}
