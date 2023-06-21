<?php

namespace App\Repositories\Admin;

use App\Models\Message\Message;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Yajra\DataTables\Facades\DataTables;

class MessageRepository extends BaseRepository
{
    public function __construct(Message $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return Message::query()
            ->select([
                'id',
                'name',
                'mobile_number',
                'username',
                'email',
                'description',
                'user_id',
                'parent_id',
                'read'
            ])
            ->where('parent_id', '=', null)
            ->with('users')
            ->latest()
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()->addColumn('users', function (Message $message) {
                    if (!is_null($message->users)) {
                        return $message->users->email;
                    }
                })
                ->addColumn('action', function ($row) {
                    return "
           <div class='d-flex justify-content-center'>
           <button type='button' class='btn btn-outline-primary btn-sm mx-2' data-toggle='modal' data-target='#orderModal' onclick='showOrderModal({$row->id})'>
            نمایش خرید های کاربر
            </button>
              <button type='button' class='btn btn-outline-info btn-sm mx-2' data-toggle='modal' data-target='#messageModal' onclick='setMessageModal({$row->id})'>
            نمایش پیام
            </button>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function showMesssage($request)
    {
        return Message::query()
            ->select([
                'id',
                'name',
                'username',
                'email',
                'description',
                'user_id',
                'parent_id'
            ])
            ->where('id', $request->messageId)
            ->with(['users', 'replies'])
            ->first();
    }

    public function showOrder($request)
    {
        $message = Message::query()
            ->select([
                'id',
                'user_id',
                'username'
            ])
            ->where('id', $request->messageId)
            ->with(['users'])
            ->first();
        if (isset($message->users)) {
            return $message->users->orders;
        } elseif (isset($message->username)) {
            $user = User::query()
                ->select([
                    'id',
                ])
                ->where('username', $message->username)
                ->first();
            return $user->orders;

        }
        return null;
    }

    public function store($request)
    {
        $user_id = Auth::id();
        $message = new Message();
        $message->parent_id = $request->parent_id;
        $message->description = $request->description;
        $message->user_id = $user_id;
        $message->save();
        $replyMessage = Message::find($request->parent_id);
        $replyMessage->read = 1;
        $replyMessage->save();
        if ($request->chat_id !== "null") {
            Telegram::bot('arioWeb')->sendMessage([
                'chat_id' => $request->chat_id,
                'text' => $message->description,
            ]);
        }
    }
}
