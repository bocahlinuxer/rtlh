<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use App\Pekerjaan;
use Auth;

class PekerjaanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaan = Pekerjaan::with(
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
        //return json_encode($pekerjaans);
        return view('admin.pekerjaan')->with('pekerjaan', $pekerjaan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pekerjaan-create');
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
        $validator = Validator::make($request->all(), Pekerjaan::$rules);

        if ($validator->fails()) {
            return redirect('pekerjaan/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        //buat variable pekerjaan
        $pekerjaan = new Pekerjaan;
        $pekerjaan->pekerjaan = $request->pekerjaan;
        $pekerjaan->status = 1;

        //set created by
        $pekerjaan->created_by_user()->associate($userlogin);

        //simpan pekerjaan baru
        $pekerjaan->save();

        Session::flash('msgsave', 'Tambah pekerjaan berhasil');
        return redirect('pekerjaan');
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
        return redirect('pekerjaan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pekerjaan = Pekerjaan::with(
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

        return view('admin.pekerjaan-edit')->with('pekerjaan', $pekerjaan);
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
        $validator = Validator::make($request->all(), Pekerjaan::$rules);

        if ($validator->fails()) {
            return redirect('pekerjaan/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        //ambil pekerjaan
        $pekerjaan = Pekerjaan::find($id);
        $pekerjaan->pekerjaan = $request->pekerjaan;
        $pekerjaan->status = 1;

        //set updated by
        $pekerjaan->updated_by_user()->associate($userlogin);

        //ubah pekerjaan
        $pekerjaan->save();
        
        Session::flash('msgedit', 'Ubah pengguna berhasil');
        return redirect('pekerjaan');
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

        //ambil pekerjaan
        $pekerjaan = Pekerjaan::find($id);
        $pekerjaan->status = 0;
        
        //set updated by
        $pekerjaan->updated_by_user()->associate($userlogin);
        $pekerjaan->save();

        Session::flash('msgdelete', 'Hapus pengguna berhasil');
        return redirect('pekerjaan');
    }
}
