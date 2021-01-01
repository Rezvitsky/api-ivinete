<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $this->validate($request, [
            'phone'      => 'required',
            'password'   => 'required|string|min:6|max:255'
        ]);

        $query = Users::where('phone', '=', $validate['phone'])->first();

        if ($query)
        {
            if (Hash::check($validate['password'], $query['password'])) {
                $data = $query->createToken('users')->accessToken;
            }
        }

        return new AuthResource($data);
    }

    public function signup(Request $request)
    {
    	$validate = $this->validate($request, [
    		'phone'      => 'required|unique:users',
    		'email'      => 'required|string|email|unique:users',
    		'password'   => 'required|string|min:6|max:255',
    		'first_name' => 'required|string|min:3|max:255',
            'last_name'  => 'required|string|min:3|max:255',
            'type'       => 'required|digits_between:0,2'
    	]);

    	$validate['password'] = Hash::make($validate['password']);

    	$query = Users::create($validate);

    	$data = $query->createToken('users')->accessToken;

    	return new AuthResource($data);
    }

    public function logout()
    {
        if (Auth::check())
        {
           $data = Auth::user()->token()->revoke();
        }

        return ['status' => $data ?? false];
    }
}
