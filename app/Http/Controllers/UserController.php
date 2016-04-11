<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function changePasswordForm()
    {
        return view('admin.changePasswordForm');
    }

    public function changePassword(Request $request)
    {
        $old_pw = $request->input('old-password');
        $new_pw = $request->input('new-password');
        $retype_new_pw = $request->input('retype-new-password');

        if ($old_pw == '' || $new_pw == ''|| $retype_new_pw == ''){
            $result = 'You must fill in all fields first!';
            $alert_type = 'warning';
        }
        else if ($new_pw != $retype_new_pw) {
            $result = 'Your password retype does not match!';
            $alert_type = 'warning';
        }
        else if ($old_pw === $new_pw) {
            $result = 'New password is the same as old password!';
            $alert_type = 'warning';
        }
        else {
            $id = Auth::user()->id;
            $user = User::find($id);
            if (Hash::check($old_pw, $user->password)) {
                $user->password = bcrypt($new_pw);
                $user->save();
                $result = 'Password successfully changed!';
                $alert_type = 'success';
            }
            else {
                $result = 'Your old password field is not correct!';
                $alert_type = 'warning';
            }
        }
        return view('admin.changePasswordResult', compact('result', 'alert_type'));
    }
}
