<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User\User;
use App\Repositories\Admin\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = $this->userRepository->getRoles();
        $permissions = $this->userRepository->getPermissions();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);
        alert()->success("با تشکر", 'نقش مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $this->userRepository->destroy($user);
        return redirect()->route('admin.users.index');
    }
}
