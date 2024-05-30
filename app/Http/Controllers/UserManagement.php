<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
class UserManagement extends Controller
{
    public function userList()
    {
        $users=User::select('id','name','email')->with('orders')->get();
        return response($users,200);
    }
    public function userStore(UserStoreRequest $request)
    {
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        return response($user,201);
    }
    public function userDetails($id)
    {
        User::findOrFail($id);
        $user= User::select('id','name','email')->with('orders')->where('id',$id)->get();
        
        return response($user,200);
    }
    public function userUpdate(UserUpdateRequest $request, $id)
    {
        $user=User::findOrFail($id);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
         return response($user,200);
    }
    public function userDelete($id)
    {
        User::findOrFail($id)->delete();
        return response([],204);
    }
}
