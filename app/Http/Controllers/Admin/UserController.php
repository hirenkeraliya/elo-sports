<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livestream;
use App\Models\Role;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

   // this function will list all the users
   public function index()
   {



      if (request()->ajax()) {



         $users = Users::has('roles', '=<', 0)->orderBy('created_at', 'desc')->get();

         return DataTables::of($users)
            ->addIndexColumn()

            ->addColumn('status', function ($q) {
           $status ='';
               if(auth()->user()->can('change-user-status')){
                 $status ='change-status';
               }

               if($q->status == 1){
                 $btn = '<a href="javascript:void(0)" data-id="' . $q->id . '"  data-username="'.$q->username.'"   data-account="deactive"   class="btn-sm btn-success  '. $status.'" ><i class="fa fa-check"></i></a>';
                  return  $btn;
               }else{
                  $btn = '<a href="javascript:void(0)" data-id="' . $q->id . '"  data-username="'.$q->username.'"  data-account="active"   class="btn-sm btn-danger '. $status.'" ><i class="fa fa-check"></i></a>';
                  return  $btn;
               }

            })
            ->addColumn('action', function ($row) {
               $rol = $row->roles->pluck('id');
               $json = json_encode($rol, JSON_UNESCAPED_UNICODE);
               $btn = '<div class="dropdown">';
               $btn .= '<button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>';
               $btn .= '<ul class="dropdown-menu">';
               if (auth()->user()->can('create-role')) {
                  $btn .= ' <li><a href="javascript:void(0)" data-roles="' .   $json . '" data-id="' . $row->id . '" class="anchor-link add-roles" >Add Roles</a></li>';
               }
               if (auth()->user()->can('create-livestream-watcher')) {
                  if ($row->can('view-livestream-watcher')) {
                     $btn .= ' <li><a href="javascript:void(0)" data-id="' . $row->id . '" data-livestrams="' . $row->startStream()->pluck('id') . '" data-id="' . $row->id . '" class="anchor-link add-livestream" >Add Livestreams</a></li>';
                  }
               }
               if (auth()->user()->can('delete-user')) {
                  // $btn .=' <li><a href="javascript:void(0)" data-id="'.$row->id.'" class="anchor-link live-delete" >Delete</a></li>';
               }
               $btn .= '</ul></div>';
               return $btn;
            })
            ->rawColumns(['action', 'username', 'email', 'firstName', 'lastName', 'phone','status'])
            ->make(true);
      }
      $livestreams = Livestream::whereNull('type')->where('status', 'started')->get();
      $roles = Role::get();
      return view('backend.users.index')->with(['roles' => $roles, 'livestreams' => $livestreams]);
   }

   public function UR_exists($url)
   {
      dd($url);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_NOBODY, true);
      curl_exec($ch);
      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      if ($code == 200) {
         $status = true;
      } else {
         $status = false;
      }
      curl_close($ch);
      return $status;
   }

   public function check123()
   {
      // http://config('app.ip_address')/{{ $livestream->stream_id }}.mp4
      $url = $this->UR_exists('http://'.config('app.ip_address').'/988d909b1e6241f1a043234d1f4432ee.mp4');
      dd($url);
   }

   // this function will delete the users
   public function destroy(Request $request)
   {

      $id = $request->id;
      if ($id) {
         $user = Users::find($id);
         $user->delete();
         return response()->json(['success' => true], 200);
      }
      return response()->json(['success' => false], 404);
   }

   // this function will add the roles to the user
   public function addRoles(Request $request)
   {

      $user = Users::find($request->id);
      $user->roles()->sync($request->roles);
      $roles = Role::whereIn('id', $request->roles)->get();
      $array = [];
      foreach ($roles as $role) {
         array_push($array, $role->permissions->pluck('id'));
      }
      $user->permissions()->sync($array[0]);

      return response()->json(['success' => true], 200);
   }
   // this function will add the livestream to the users
   public function addLivestream(Request $request)
   {

      $user = Users::find($request->id);
      $stream = Livestream::whereIn('id', $request->livestream)->get();
      $user->canmonitor()->sync($stream->pluck('id')->toArray());
      return response()->json(['success' => true], 200);
   }
   // this function will change the status of the users
   public function changeStatus(Request $request){
      $user = Users::find($request->id);
      if($user->status == 1){
         $status =0;
      }else{
         $status =1;
      }
      $user->update(['status'=>$status]);
      return response()->json(['success' => true], 200);
   }

   // this function will lists all the admin users
   public function admin()
   {



      if (request()->ajax()) {



         $users = Users::has('roles', '>', 0)->orderBy('created_at', 'desc')->get();

         return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('roles', function ($q) {
               return $q->roles()->pluck('name')->implode(',');
            })
            ->addColumn('status', function ($q) {
               if($q->status == 1){
                 $btn = '<a href="javascript:void(0)" data-id="' . $q->id . '"  data-username="'.$q->username.'"   data-account="deactive"   class="btn-sm btn-success  change-status" ><i class="fa fa-check"></i></a>';
                  return  $btn;
               }else{
                  $btn = '<a href="javascript:void(0)" data-id="' . $q->id . '"  data-username="'.$q->username.'"   data-account="active"  class="btn-sm btn-danger  change-status" ><i class="fa fa-check"></i></a>';
                  return  $btn;
               }

            })
            ->addColumn('action', function ($row) {
               $rol = $row->roles->pluck('id');
               $json = json_encode($rol, JSON_UNESCAPED_UNICODE);
               $btn = '<div class="dropdown">';
               $btn .= '<button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>';
               $btn .= '<ul class="dropdown-menu">';
               if (auth()->user()->can('create-role')) {
                  $btn .= ' <li><a href="javascript:void(0)" data-roles="' .   $json . '" data-id="' . $row->id . '" class="anchor-link add-roles" >Add Roles</a></li>';
               }
               if (auth()->user()->can('create-livestream-watcher')) {
                  if ($row->can('view-livestream-watcher')) {
                     $btn .= ' <li><a href="javascript:void(0)" data-id="' . $row->id . '" data-livestrams="' . $row->startStream()->pluck('id') . '"  class="anchor-link add-livestream" >Add Livestreams</a></li>';
                  }
               }
               if (auth()->user()->can('delete-user')) {
                  // $btn .=' <li><a href="javascript:void(0)" data-id="'.$row->id.'" class="anchor-link live-delete" >Delete</a></li>';
               }
               $btn .= '</ul></div>';
               return $btn;
            })
            ->rawColumns(['action', 'username', 'email', 'firstName', 'lastName', 'phone', 'roles','status'])
            ->make(true);
      }
      $livestreams = Livestream::whereNull('type')->get();
      $roles = Role::get();
      return view('backend.users.admin')->with(['roles' => $roles, 'livestreams' => $livestreams]);
   }
}
