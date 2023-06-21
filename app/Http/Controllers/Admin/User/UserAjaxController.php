<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;

class UserAjaxController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->userRepository->getDatatableData($request);
    }
}
