<?php


namespace App\Actions\Admin\Users;

use App\Http\Resources\UserResource;
use App\Models\User;

class UsersAction
{



    public function allUsers()
    {
        $allUsers = User::where('role', '!=', 'admin')->orderBy('id', 'desc')->paginate(100);


        return UserResource::collection($allUsers);
    }

    public function pendingUsers()
    {
        $pendingUsers = User::where('role', '!=', 'admin')->where('status', 'pending')->orderBy('id', 'desc')->paginate(100);

        return UserResource::collection($pendingUsers);
    }
    public function activeUsers()
    {
        $activeUsers = User::where('role', '!=', 'admin')->where('status', 'active')->orderBy('id', 'desc')->paginate(100);

        return UserResource::collection($activeUsers);
    }
    public function suspendedUsers()
    {
        $suspendedUsers = User::where('role', '!=', 'admin')->where('status', 'suspended')->orderBy('id', 'desc')->paginate(100);

        return UserResource::collection($suspendedUsers);
    }

}
