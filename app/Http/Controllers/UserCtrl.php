<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserCtrl extends Controller
{
    public function index(){
        $all_users = User::all();

        return view('admin.users.index')->with(['users'=>$all_users]);
    }
    public function show(User $user){

        $user_roles = [];
        foreach($user->rolesBTM as $role_i){
            array_push($user_roles, $role_i->name);
        }
        $user['roles'] = $user_roles;

        return view('admin.users.profile')->with(['user'=>$user]);
    }
    public function edit(User $user){
        $this->authorize('view', $user);

        return view('admin.users.profile_edit')->with(['user'=>$user]);
    }
    public function update(Request $req, User $user){

        $authed_user = User::find(Auth::user()->id);

        $req->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'profile_pic'=>'file',
            'cover_photo'=>'file'
        ]);

        $input = $req->all();

        if($req->profile_pic){
            $input['profile_pic'] = $req->profile_pic->store('profile_pic');
            $authed_user->profile_pic = $input['profile_pic'];
        }
        if($req->cover_photo){
            // if($user->cover_photo){
            //     // Storage::delete($user->cover_photo);
            //     dd(storage_path('app/'.$user->cover_photo));
            //     Storage::delete(storage_path('app\public/'.$user->cover_photo));
            // }
            $input['cover_photo'] = $req->cover_photo->store('cover_photo');
            $authed_user->cover_photo = $input['cover_photo'];
        }

        // if($req->password){
        //     $req->validate([
        //         'password' => 'min:5',
        //     ]);

        //     $user->password = $req->password;
        // }
        $authed_user->name = $input['name'];
        $authed_user->email = $input['email'];

        $authed_user->save();

        return redirect()->route('user.profile', $authed_user);
    }
    public function destroy(Request $req, User $user){
        $deleted_user_name = $user->name;
        
        $user->delete();

        $req->session()->flash('deleted-msg', $deleted_user_name.' has been deleted');

        return redirect()->route('user.index');
    }

    public function role_edit(User $user){
        $all_roles = Role::all();   

        return view('admin.users.edit_user')->with(['user'=>$user, "roles"=>$all_roles]);
    }
    public function role_attach(User $user, Role $role){
        if($role->name == "admin"){
            $mod_role = Role::where('name', 'moderator')->first();
            $user->rolesBTM()->attach($mod_role);
        } 
        
        $found_role = Role::where('name', $role->name)->first();
        $user->rolesBTM()->attach($found_role);

        return redirect()->back();
    }
    public function role_detach(User $user, Role $role){
        if($role->name == "moderator" && $user->UserHasRole('admin')){
            $admin_role = Role::where('name', "admin")->first();
            $user->rolesBTM()->detach($admin_role);
        }
        $found_role = Role::where('name', $role->name)->first();
        $user->rolesBTM()->detach($found_role);

        return redirect()->back();
    }
}
