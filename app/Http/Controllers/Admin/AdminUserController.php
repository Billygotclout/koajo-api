<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Users\UsersAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function allUsers()
    {
        return (new UsersAction)->allUsers();
    }
    public function pendingUsers()
    {
        return (new UsersAction)->pendingUsers();
    }
    public function activeUsers()
    {
        return (new UsersAction)->activeUsers();
    }
    public function suspendedUsers()
    {
        return (new UsersAction)->suspendedUsers();
    }

}
