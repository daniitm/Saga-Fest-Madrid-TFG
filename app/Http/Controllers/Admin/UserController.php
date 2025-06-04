<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users; 
    }

    public function index()
    {
        $users = $this->users->paginate(15, ['role' => 'user']);
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->users->find($id);
        return view('admin.users.show', compact('user'));
    }
}
