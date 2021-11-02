<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Admin\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index(UserDatatable $user)
    {
        return $user->render('admin.accounts.users.index', ['title' => 'Admin Control']);
    }

    public function create()
    {
        return view('admin.accounts.users.create', ['title' => 'Create User']);
    }

    public function store(CreateUserRequest $request)
    {
        $request->validated();
        return $this->userRepo->store_user($request);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $title = 'Edit User';
        return view('admin.accounts.users.edit', compact('user', 'title'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return $this->userRepo->update_user($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->userRepo->multi_delete($request);
    }
}
