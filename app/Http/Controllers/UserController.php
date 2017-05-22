<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(
            [
                'created_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'updated_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                }
            ]
        )->where('status', '<>', 0)->get();
        
        //buat ngetes
        //return json_encode($users);
        return view('user')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), User::$rules);

        if ($validator->fails()) {
            return redirect('user/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        //buat variable user
        $user = new User;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->tipe = $request->tipe;
        $user->status = 1;

        //set created by
        $user->created_by_user()->associate($userlogin);

        //simpan user baru
        $user->save();

        Session::flash('msgsave', 'Tambah pengguna berhasil');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(
            [
                'created_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'updated_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                }
            ]
        )->get()->find($id);

        return view('user-edit')->with('user', $user);
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
        //validasi
        $validator = Validator::make($request->all(), User::$updaterules);

        if ($validator->fails()) {
            return redirect('user/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        //ambil user
        $user = User::find($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->tipe = $request->tipe;
        $user->status = 1;

        if($request->password != "")
        {
            $user->password = bcrypt($request->password);
        }

        //set updated by
        $user->updated_by_user()->associate($userlogin);

        //ubah user
        $user->save();
        
        Session::flash('msgedit', 'Ubah pengguna berhasil');
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ambil user yang login
        $userlogin = Auth::user();

        //ambil user
        $user = User::find($id);
        $user->status = 0;
        
        //set updated by
        $user->updated_by_user()->associate($userlogin);
        $user->save();

        Session::flash('msgdelete', 'Hapus pengguna berhasil');
        return redirect('user');
    }
}
