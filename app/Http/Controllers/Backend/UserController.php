<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function editPassword()
    {
        return view('backend.user.editPassword');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        if (! Hash::check($oldPassword, $user->password)) {
            flash()->error('原密码不正确');
            return redirect()->back();
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        flash()->success('修改成功');
        return redirect()->back();
    }

}
