<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CustomerAuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            //'l_name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ], [
            'f_name.required' => 'The first name field is required.',
            'phone.required' => 'The  phone field is required.',
        ]);
//
        if ($validator->fails()) {
            return response()->json(['errors' => "Couldn't validate"], 403);
        }

//        if ($validator->fails()) {
//            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
//        }
        $user = User::create([
            'f_name' => $request->f_name,
            //'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('RestaurantCustomerAuth')->accessToken;


        return response()->json(['token' => $token, 'name'=>$user->f_name ,'email'=>$user->email], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => "Errors"], 403);
        }

//        if ($validator->fails()) {
//            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
//        }
        $data = [
            'phone' => $request->phone,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('RestaurantCustomerAuth')->accessToken;


            return response()->json(['token' => $token, 'name'=>auth()->user()->f_name], 200);
        } else {

            return response()->json([
                'errors' => "Something went wrong"
            ], 401);
        }
    }
}
