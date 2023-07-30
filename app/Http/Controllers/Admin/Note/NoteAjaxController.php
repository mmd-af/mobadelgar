<?php

namespace App\Http\Controllers\Admin\Note;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\NoteRepository;
use Illuminate\Http\Request;

class NoteAjaxController extends Controller
{
    protected $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function destroy($note)
    {
        $this->noteRepository->destroy($note);
        return response()->json([
            'data' => $note
        ]);
    }
}
