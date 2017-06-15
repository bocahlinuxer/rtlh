<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use App\Rtlh;
use App\Pekerjaan;
use App\Kecamatan;
use Auth;

class RtlhController extends Controller
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
                }
            ]
        )->where('status', '<>', 0)->get();
        
        return view('admin.rtlh')->with('rtlh', $rtlh);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::with('desa')->where('status', '<>', 0)->get();
        $pekerjaan = Pekerjaan::where('status', '<>', 0)->get();
        return view('admin.rtlh-create')->with(array(
            "pekerjaan" => $pekerjaan,
            "kecamatan" => $kecamatan
            ));
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
        $validator = Validator::make($request->all(), Rtlh::$rules);

        if ($validator->fails()) {
            return redirect('admin/rtlh/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = new Rtlh;
        $rtlh->nama = $request->nama;
        $rtlh->nik = $request->nik;
        $rtlh->alamat = $request->alamat;
        $rtlh->jumlah_tanggungan = $request->jumlah_tanggungan;
        $rtlh->penghasilan = $request->penghasilan;
        $rtlh->luas_rumah = $request->luas_rumah;
        $rtlh->id_desa = $request->desa;
        $rtlh->id_pekerjaan = $request->pekerjaan;
        $rtlh->kondisi_lantai = $request->kondisi_lantai;
        $rtlh->kondisi_atap = $request->kondisi_atap;
        $rtlh->kondisi_dinding = $request->kondisi_dinding;
        $rtlh->utilitas_air = $request->utilitas_air;
        $rtlh->utilitas_listrik = $request->utilitas_listrik;
        $rtlh->utilitas_mck = $request->utilitas_mck;
        $rtlh->bukti = $request->bukti;
        $rtlh->latitude = $request->latitude;
        $rtlh->longitude = $request->longitude;
        $rtlh->data_lainnya = $request->data_lainnya;
        $rtlh->status = 1;

        //set created by
        $rtlh->created_by_user()->associate($userlogin);

        //simpan user baru
        $rtlh->save();

        return redirect('admin/rtlh');
        Session::flash('msgsave', 'Tambah RTLH berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
                'foto_rtlh'
            ]
        )->find($id);
        
        return view('admin.rtlh-detail')->with('rtlh', $rtlh);
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
        $pekerjaan = Pekerjaan::where('status', '<>', 0)->get();
        $rtlh = Rtlh::find($id);

        return view('admin.rtlh-edit')->with(array(
            "pekerjaan" => $pekerjaan,
            "kecamatan" => $kecamatan,
            "rtlh" => $rtlh
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
        $validator = Validator::make($request->all(), Rtlh::$rules);

        if ($validator->fails()) {
            return redirect('admin/rtlh/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = Rtlh::find($id);

        $rtlh->nama = $request->nama;
        $rtlh->nik = $request->nik;
        $rtlh->alamat = $request->alamat;
        $rtlh->jumlah_tanggungan = $request->jumlah_tanggungan;
        $rtlh->penghasilan = $request->penghasilan;
        $rtlh->luas_rumah = $request->luas_rumah;
        $rtlh->id_desa = $request->desa;
        $rtlh->id_pekerjaan = $request->pekerjaan;
        $rtlh->kondisi_lantai = $request->kondisi_lantai;
        $rtlh->kondisi_atap = $request->kondisi_atap;
        $rtlh->kondisi_dinding = $request->kondisi_dinding;
        $rtlh->utilitas_air = $request->utilitas_air;
        $rtlh->utilitas_listrik = $request->utilitas_listrik;
        $rtlh->utilitas_mck = $request->utilitas_mck;
        $rtlh->bukti = $request->bukti;
        $rtlh->latitude = $request->latitude;
        $rtlh->longitude = $request->longitude;
        $rtlh->data_lainnya = $request->data_lainnya;

        //set created by
        $rtlh->updated_by_user()->associate($userlogin);

        //simpan user baru
        $rtlh->save();

        Session::flash('msgedit', 'Ubah RTLH berhasil');
        return redirect('admin/rtlh/'.$rtlh->id_rtlh);
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

        $rtlh = Rtlh::find($id);

        //soft deleting
        $rtlh->status = 0;

        //set created by
        $rtlh->updated_by_user()->associate($userlogin);

        //simpan user baru
        $rtlh->save();

        Session::flash('msgdelete', 'Hapus RTLH berhasil');
        return redirect('admin/rtlh');
    }
}
