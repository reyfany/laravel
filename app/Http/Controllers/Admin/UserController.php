<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Hash;
use DB;
// use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // function __construct(){
    //     $this -> middleware(['role:admin']);
    // }

    // public function __construct()
    // {
    //     $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
    // }

    public function index()
    {
        //
        $pagename='Data User';
        //siapkan pagename tambah user
        $allUser=User::all();
         //data semua role dikirim dari kontroller all permision diterima ke index.blade.php
        return view('admin.user.index',compact('pagename','allUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagename='Tambah User';
        //siapkan pagename tambah role
        $allRoles=role::all();
         //data semua role dikirim dari kontroller all permision diterima ke create.blade.php
        return view('admin.user.create',compact('pagename','allRoles'));
        //mengembalikan view pada bagian admin.role.create sertakan data pagename dan allPermission
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'txtnama_user'=>'required',
            'txtemail_user'=>'required|email|unique:users,email',
            'txtpassword_user'=>'required|same:txtkonfirmasipassword_user',
            'role_user'=>'required'
        ]);
        $user=new user();
        $user->name=$request->txtnama_user;
        $user->email=$request->txtemail_user;
        $user->password=Hash::make($request->txtpassword_user);
        $user->save();

        $user->assignRole($request->role_user);
        return redirect()->route('users.index')->with('sukses','User berhasil dibuat');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pagename='Edit User';
        $user=User::find($id);
        $allRoles=Role::all();
        $userRole=$user->roles->pluck('id')->all();

        return view('admin.user.edit', compact('pagename', 'user', 'allRoles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'txtnama_user'=>'required',
            'txtemail_user'=>'required|email',
            // 'txtpassword_user'=>'required|same:txtkonfirmasipassword_user',
            'role_user'=>'required'
        ]);

        $user=User::find($id);
        $user->name=$request->txtnama_user;
        $user->email=$request->txtemail_user;
        if($request->txtpassword_user !=null){
            $user->password=Hash::make($request->txtpassword_user);
        }
        $user->update();

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->role_user);
        return redirect()->route('users.index')->with('sukses','User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=user::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('sukses','User berhasil dihapus');
    }
}
