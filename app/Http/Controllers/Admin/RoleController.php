<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class RoleController extends Controller
{
    
    // this function will fetch all the roes 
    public function index(){
        if (request()->ajax()) {
           
             
            $livestreams = Role::orderBy('created_at','desc')->get();
            return DataTables::of($livestreams)
            ->addIndexColumn()
                 
                 ->addColumn('action',function($row){
                    $btn = '';
                   if(auth()->user()->can('edit-role')){
                    $btn .='<a href="'.url('edit-role/'.$row->id).'"  class="btn btn-xs btn-info" title="Edit"><i class="fas fa-pencil-alt "></i></a>';
                   }
                   if(auth()->user()->can('delete-role')){
                   $btn .=' <a href="javascript:void(0)" data-id="'.$row->id.'" data-name="'.$row->name.'" class="btn btn-xs btn-danger delete-role" title="Delete"> <i class="fa fa-trash"></i></a>';
                   }
                 $btn .='</ul></div>';
                   return $btn;
                 })
                 ->rawColumns(['action','name','slug'])
                 ->make(true);
         }
         return view('backend.roles.index');
    }
    // this function will display the form to create the roles
    public function create(){

        $permissions = Permission::get();
        return view('backend.roles.create')->with('permissions',$permissions);
    }

    // this function will save the roles
    public function store(Request $request){

        $data =[
            'name'=>'required|unique:roles,name',
            "permissions"    => "required|array|min:1",
            "permissions.*"  => "required|string|distinct|min:1",
           
        ];
         $validation =    Validator::make($request->all(),$data);
      
        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        $permissions = $request->permissions;
        $data = $request->except('_token','permissions');
        $role = Role::create($data);
        $role->permissions()->sync($permissions);
        return redirect()->to('/roles');
    }
    // this function will fetcht the roles for edit 
    public function edit($id){
        $role = Role::find($id);
      
        $permissions = Permission::get();
        return view('backend.roles.edit')->with([
            'permissions'=>$permissions,
            'role'=>$role
        ]);
    }
    // this function will update the roles
    public function update(Request $request,$id){
        $data =[
            'name'=>'required|unique:roles,name,'.$id,
            "permissions"    => "required|array|min:1",
            "permissions.*"  => "required|string|distinct|min:1",
           
        ];
         $validation =    Validator::make($request->all(),$data);
      
        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        $role = Role::find($id);
        $role->update(['name'=>$request->name]);
        $permissions = $request->permissions;
        $role->permissions()->sync($permissions);
        return redirect()->to('/roles');
    }
    // this function will delte the role
    public function destroy(Request $request){
        $id = $request->id;
        $role = Role::find($id);
         if($role){
             $rper =  $role->permissions->pluck('id')->toArray();

             if($role->users){
                foreach($role->users as $user){
                    $user->permissions()->detach($rper);
                }
             }
            $role->permissions()->detach();
            $role->delete();
            return response()->json(['success'=>true],200);
         }
         return response()->json(['success'=>false],404);
      }
}
