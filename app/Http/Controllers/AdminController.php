<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function user(Request $req)
    {
        $user = Auth::user();
        $users = User::all();
        $roles = Role::all();
        return view('admin.user', compact('user', 'users', 'roles'));
    }

    public function submit_user(Request $req){
        $this->validate($req, [
            'username' => 'unique:users',
            'email' => 'email|unique:users'
        ]);

        $user = new User;

        $user['name'] = $req->name;
        $user['username'] = $req->username;
        $user['email'] = $req->email;
        $user['password'] = bcrypt($req->password);
        $user['roles_id'] = $req->roles_id;
        $user['photo'] = $req->photo;

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_user' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_user', $filename
            );

            $user->photo = $filename;
        }

        $notification = array(
            'message' => 'user Produk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if($req->password != null){
            $user['password'] = bcrypt($req->password);
        }

        $user->save();

        return redirect(route('admin.user'))->with('success','Berhasil diubah');
    }

    public function getDataUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update_user(Request $req){

        $user = User::find($req->get('id'));

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->roles_id = $req->get('roles_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_user'.time().'.'. $extension;

            $req->file('photo')->storeAs(
                'public/photo_user', $filename
            );
            Storage::delete('public/photo_user/'.$req->get('old_user'));
            $user->photo = $filename;
        }

        $user->save();

        if($req->password != null){
            $user['password'] = bcrypt($req->password);
        }

        $notification = array(
            'message' => 'Data Produk berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect(route('admin.user'))->with($notification);
    }

    public function delete_user(Request $req)
    {
        $user = User::find($req->get('id'));

        Storage::delete('public/photo_user/'.$req->get('old_photo'));

        $notification = array(
            'message' => 'Data Produk berhasil dihapus',
            'alert-type' => 'danger'
        );

        $user->delete();

        return redirect()->route('admin.user')->with($notification);
    }

}
