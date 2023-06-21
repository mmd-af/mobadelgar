<?php

namespace App\Repositories\Admin;

use App\Models\User\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function getAll()
    {
        return User::query()
            ->select([
                'id',
                'firstname',
                'lastname',
                'mobile_number',
                'is_active'
            ])
            ->get();
    }

    public function getDatatableData($request)
    {
        if ($request->ajax()) {
            $data = $this->getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('admin.users.edit', $row->id);
                    return "
                    <div class='d-flex justify-content-center'>
                    <a href='{$edit}' class='btn btn-outline-info btn-sm mx-2'>ویرایش</a>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getPermissions()
    {
        return Permission::query()
            ->select([
                'id',
                'name',
                'display_name'
            ])
            ->get();
    }

    public function getRoles()
    {
        return Role::query()
            ->select([
                'id',
                'name',
                'display_name'
            ])
            ->get();
    }

    public function update($request, $user)
    {
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->save();

        $user->syncRoles($request->role);
        $permissions = $request->except('_token', 'firstname', 'lastname', 'role', '_method');
        $user->syncPermissions($permissions);
    }
}
