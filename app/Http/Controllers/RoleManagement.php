<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use App\Models\Roles;
use Illuminate\Http\Request;
use Validator;

class RoleManagement extends Controller
{
    public function roleStore(RoleStoreRequest $request)
    {
        $role=Role::create([
            'name'=>$request->name
        ]);
        return response($role,201);
    }
    public function roleList(){
        $role=Role::all();
        return response($role , 200);
    }
    public function roleDetails($id){
        Role::findOrFail($id);
        $role= Role::select('id','name')->with('user')->where('id',$id)->get();
        return response($role,200);
    }
    public function roleUpdate(request $request,$id){
        
        if($id==1 or $id==2)
            return response('Cant Update This Role!',403);
        else
        {
            $role=Role::findOrFail($id);
            $this->validate($request, [
                'name'=>'required|unique:roles,name'
            ]);
            $role->update([
                'name'=>$request->name
            ]);
        }
            
            return response($role,200);
    }
    public function roleDelete($id)
    {
        if($id==1 or $id==2)
            return response('Cant Delete This Role!',403);
        else
            Role::findOrFail($id)->delete();
        return response([],204);
    }

}
