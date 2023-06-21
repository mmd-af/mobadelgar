<?php

namespace App\Http\Controllers\Admin\Message;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\MessageRepository;
use Illuminate\Http\Request;

class MessageAjaxController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function getDatatableData(Request $request)
    {
        return $this->messageRepository->getDatatableData($request);
    }

    public function showMesssage(Request $request)
    {
        return $this->messageRepository->showMesssage($request);
    }

    public function showOrder(Request $request)
    {
        return $this->messageRepository->showOrder($request);
    }
}
