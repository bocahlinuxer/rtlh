<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use App\Rtlh;
use App\Kecamatan;
use App\Pekerjaan;
use Auth;
use Carbon\Carbon;

class VerifikasiController extends Controller
{
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
        )->where('status', '=', 1)->get();
        
        return view('admin.verifikasi.verifikasi-belum')->with('rtlh', $rtlh);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
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

        if($rtlh != null)
        {
        	return view('admin.verifikasi.verifikasi-detail')->with('rtlh', $rtlh);
        }
        else
        {
        	return view('admin.verifikasi.errors/204');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function crosscheck($id)
    {
        $kecamatan = Kecamatan::with('desa')->where('status', '<>', 0)->get();
        $pekerjaan = Pekerjaan::where('status', '<>', 0)->get();
        $rtlh = Rtlh::find($id);

        return view('admin.verifikasi.verifikasi-crosscheck')->with(array(
            "rtlh" => $rtlh,
            "pekerjaan" => $pekerjaan,
            "kecamatan" => $kecamatan
            ));;
    }

    public function verifikasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Rtlh::$verifikasirules);

        if ($validator->fails()) {
            return redirect('adminverifikasi/verifikasi/'.$id.'/crosscheck')
                        ->withErrors($validator)
                        ->withInput();
        }

        //ambil user yang login
        $userlogin = Auth::user();

        //buat variable user
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
        $rtlh->jenis_penanganan = $request->jenis_penanganan;
        $rtlh->sumber_data = $request->sumber_data;
        $rtlh->data_lainnya = $request->data_lainnya;
        $rtlh->status = 2;

        //set created by
        $rtlh->verified_at = Carbon::now();
        $rtlh->verified_by_user()->associate($userlogin);

        //simpan user baru
        $rtlh->save();

        Session::flash('msgedit', 'verifikasi pengajuan RTLH berhasil');
        return redirect('adminverifikasi/verifikasi/'.$rtlh->id_rtlh);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sudah()
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
        )->where('status', '>=', 2)->get();
        
        return view('admin.verifikasi.verifikasi-sudah')->with('rtlh', $rtlh);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailsudah($id)
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
        )->where('status', '>=', 2)->find($id);

        if($rtlh != null)
        {
        	return view('admin.verifikasi.verifikasi-sudah-detail')->with('rtlh', $rtlh);
        }
        else
        {
        	return view('admin.verifikasi.errors/204');
        }
    }
}
