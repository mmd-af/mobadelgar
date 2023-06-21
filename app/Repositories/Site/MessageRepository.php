<?php

namespace App\Repositories\Site;

use App\Models\Message\Message;

class MessageRepository extends BaseRepository
{
    public function __construct(Message $model)
    {
        $this->setModel($model);
    }
    public function store($request)
    {
        $message = new Message();
        $message->name = $request->name;
        $message->mobile_number = $request->mobile_number;
        $message->email = $request->email;
        $message->description = "موضوع: ".$request->title." - ".$request->description;
        $message->save();
    }
}
