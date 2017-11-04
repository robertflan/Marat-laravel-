<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\User;

class changePasswordController extends Controller
{
    public function changePasswordForm()
    {

        return view('auth.passwords.change');
    }

    public function changePassword(Request $request, $id)

    {
       $user = User::find($id);
       

       if (Hash::check($request->password, $user->password))
        {
            User::where('id', $id)->update(['password'=>Hash::make($request->password_2)]);
            return redirect('/');
        }
    }
}

