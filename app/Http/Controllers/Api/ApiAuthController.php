<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ApiAuthController extends Controller
{
    public function Register(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'fullname' => 'required',
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'confirm_password' => 'required|same:password'
       ]);

       if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'terjadi kesalahan',
            'data' => $validator->errors()
        ]);
    }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['email'] = $user->email;
        $success['fullname'] = $user->fullname;

        return response()->json([
          'success' => true,
          'message' => 'Registrasi Berhasil',
            'data' => $success
        ]);

    }


    public function Login(Request $request)
    {
        $loginType = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $login = [
            $loginType => $request->input('email'),
            'password' => $request->password,
        ];
    
        if (Auth::attempt($login)) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;

            return response()->json([
              'success' => true,
              'message' => 'Login Berhasil',
                'data' => $success
            ]);
    }else{
        return response()->json([
          'success' => false,
          'message' => 'Email atau Password Salah',
          'data' => null
        ]);
    }

}

}
