<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use App\User;
use App\Kecamatan;
use Auth;

class UserController extends Controller
{
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
                },
                'desa' => function($q)
                {
                    $q->select('id_desa', 'desa', 'id_kecamatan');
                },
                'desa.kecamatan' => function($q)
                {
                    $q->select('id_kecamatan', 'kecamatan');
                }
            ]
        )->where('status', '<>', 0)->get();
        
        //buat ngetes
        //return json_encode($users);
        return view('admin.superadmin.user')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::with('desa')->where('status', '<>', 0)->get();
        return view('admin.superadmin.user-create')->with('kecamatan', $kecamatan);
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
            return redirect('superadmin/user/create')
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

        if($user->tipe == 2)
        {
            $user->id_desa = $request->desa;
        }

        $user->status = 1;

        //set created by
        $user->created_by_user()->associate($userlogin);

        //simpan user baru
        $user->save();

        Session::flash('msgsave', 'Tambah pengguna berhasil');
        return redirect('superadmin/user');
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
        return redirect('superadmin/user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::with('desa')->where('status', '<>', 0)->get();
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

        return view('admin.superadmin.user-edit')->with(array(
            'kecamatan' => $kecamatan,
            'user' => $user
            ));
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
            return redirect('superadmin/user/'.$id.'/edit')
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

        if($user->tipe == 2)
        {
            $user->id_desa = $request->desa;
        }

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
        return redirect('superadmin/user');
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
        return redirect('superadmin/user');
    }
}
