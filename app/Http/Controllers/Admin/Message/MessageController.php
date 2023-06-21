<?php

namespace App\Http\Controllers\Admin\Message;

use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use App\Repositories\Admin\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function index()
    {
        return view('admin.messages.index');
    }

    public function store(Request $request)
    {
        $this->messageRepository->store($request);
        return view('admin.messages.index');
    }

}
