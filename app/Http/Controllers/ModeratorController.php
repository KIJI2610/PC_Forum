<?php

namespace App\Http\Controllers;

use App\Models\User;

class ModeratorController extends Controller
{
    public function showUsers()
    {
        $users = User::paginate(3);
        return view('moderator.showUsers', ['users' => $users]);
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);
        $userRole = $user->role->name;
        if ($userRole == 'user') {
            $user->role_id = 2;
            $user->save();
            return redirect()->back();
        }
        $user->role_id = 1;
        $user->save();
        return redirect()->back();
    }

    public function changeBanStatus($id)
    {
        $user = User::findOrFail($id);
        //0 - нет бана, 1 - есть бан
        if ($user->ban_status) {
            $user->ban_status = 0;
            $user->save();
            return redirect()->back();
        }
        $user->ban_status = 1;
        $user->save();
        return redirect()->back();
    }
}
