<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Rtlh;
use App\Penanganan;
use App\Opd;
use Auth;

class PenangananController extends Controller
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
    public function index($idrtlh)
    {
        $rtlh = Rtlh::with(
            [
                'created_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'updated_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'verified_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'pekerjaan' => function($q)
                {
                    $q->select('id_pekerjaan', 'pekerjaan');
                },
                'desa' => function($q)
                {
                    $q->select('id_desa', 'desa', 'id_kecamatan');
                },
                'desa.kecamatan' => function($q)
                {
                    $q->select('id_kecamatan', 'kecamatan');
                },
                'foto_rtlh',
                'penanganan',
                'penanganan.opd'
            ]
        )->where('status', '=', 2)->find($idrtlh);

        if($rtlh != null)
        {
            return view('verifikasi-penanganan')->with('rtlh', $rtlh);
        }
        else
        {
            return view('errors/204');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idrtlh)
    {
        $opd = Opd::where('status', '<>', 0)->get();

        return view('verifikasi-penanganan-create')->with(array(
            "idrtlh" => $idrtlh,
            "opd" => $opd
            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idrtlh, Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), Penanganan::$rules);

        if ($validator->fails()) {
            return redirect('terverifikasi/'.$idrtlh.'/penanganan/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = Rtlh::find($idrtlh);
        $opd = Opd::find($request->id_opd);

        //buat variable user
        $penanganan = new Penanganan;

        //set rtlh
        $penanganan->rtlh()->associate($rtlh);

        $penanganan->status = 1;

        //set opd
        $penanganan->opd()->associate($opd);

        //set created by
        $penanganan->created_by_user()->associate($userlogin);

        $penanganan->save();

        if ($request->file('foto0')->isValid()) {
            $img = "img0-".$penanganan->id_penanganan.".".$request->file('foto0')->getClientOriginalExtension();

            $basepath = public_path().'/img/penanganan/';
            $penanganan->foto0 = $img;
            
            //intervention image api
            // Image::make($request -> file_fotortlh)
            // ->resize(800, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })
            // ->save($basepath.$img);

            Image::make($request -> foto0)->save($basepath.$img);

            $penanganan->save();
        }

        if ($request->file('foto100')->isValid()) {
            $img = "img100-".$penanganan->id_penanganan.".".$request->file('foto100')->getClientOriginalExtension();

            $basepath = public_path().'/img/penanganan/';
            $penanganan->foto100 = $img;
            
            //intervention image api
            // Image::make($request -> file_fotortlh)
            // ->resize(800, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })
            // ->save($basepath.$img);

            Image::make($request -> foto100)->save($basepath.$img);

            $penanganan->save();
        }

        Session::flash('msgsave', 'Tambah Penanganan RTLH berhasil');
        return redirect('terverifikasi/'.$idrtlh.'/penanganan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idrtlh, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idrtlh, $id)
    {
        $opd = Opd::where('status', '<>', 0)->get();
        $penanganan = Penanganan::with('opd')->find($id);

        return view('verifikasi-penanganan-edit')->with(array(
            'idrtlh' => $idrtlh,
            'id' => $id,
            'opd' => $opd,
            'penanganan' => $penanganan
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($idrtlh, Request $request, $id)
    {
        //validasi
        $validator = Validator::make($request->all(), Penanganan::$updaterules);

        if ($validator->fails()) {
            return redirect('terverifikasi/'.$idrtlh.'/penanganan/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = Rtlh::find($idrtlh);
        $opd = Opd::find($request->id_opd);

        //buat variable user
        $penanganan = Penanganan::find($id);

        //set opd
        $penanganan->opd()->associate($opd);

        $penanganan->status = 1;

        //set created by
        $penanganan->updated_by_user()->associate($userlogin);

        $penanganan->save();

        if ($request->hasFile('foto0')) {
            if ($request->file('foto0')->isValid()) {
                $img = "img0-".$penanganan->id_penanganan.".".$request->file('foto0')->getClientOriginalExtension();

                $basepath = public_path().'/img/penanganan/';
                $penanganan->foto0 = $img;
                
                //intervention image api
                // Image::make($request -> file_fotortlh)
                // ->resize(800, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // })
                // ->save($basepath.$img);

                Image::make($request -> foto0)->save($basepath.$img);

                $penanganan->save();
            }
        }

        if ($request->hasFile('foto100')) {
            if ($request->file('foto100')->isValid()) {
                $img = "img100-".$penanganan->id_penanganan.".".$request->file('foto100')->getClientOriginalExtension();

                $basepath = public_path().'/img/penanganan/';
                $penanganan->foto100 = $img;
                
                //intervention image api
                // Image::make($request -> file_fotortlh)
                // ->resize(800, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // })
                // ->save($basepath.$img);

                Image::make($request -> foto100)->save($basepath.$img);

                $penanganan->save();
            }
        }

        Session::flash('msgedit', 'Ubah Penanganan RTLH berhasil');
        return redirect('terverifikasi/'.$idrtlh.'/penanganan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idrtlh, $id)
    {
        $penanganan = Penanganan::find($id);
        $penanganan->delete();

        Session::flash('msgdelete', 'Hapus Penanganan RTLH berhasil');
        return redirect('terverifikasi/'.$idrtlh.'/penanganan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekap()
    {
        $penanganan = Penanganan::with(
            [
                'created_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'updated_by_user' => function($q)
                {
                    $q->select('id_user', 'nama');
                },
                'rtlh',
                'opd'
            ]
        )->where('status', '<>', 0)->get();

        return view('rekap-penanganan')->with('penanganan', $penanganan);
    }
}
