<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use App\Rtlh;
use Auth;
use Carbon\Carbon;

class VerifikasiController extends Controller
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
        
        return view('admin.verifikasi-belum')->with('rtlh', $rtlh);
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
        	return view('admin.verifikasi-detail')->with('rtlh', $rtlh);
        }
        else
        {
        	return view('admin.errors/204');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifikasi(Request $request, $id)
    {
        //ambil user yang login
        $userlogin = Auth::user();

        //buat variable user
        $rtlh = Rtlh::find($id);

        $rtlh->status = 2;

        //set created by
        $rtlh->verified_at = Carbon::now();
        $rtlh->verified_by_user()->associate($userlogin);

        //simpan user baru
        $rtlh->save();

        Session::flash('msgedit', 'verifikasi pengajuan RTLH berhasil');
        return redirect('verifikasi/'.$rtlh->id_rtlh);
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
        )->where('status', '=', 2)->get();
        
        return view('admin.verifikasi-sudah')->with('rtlh', $rtlh);
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
        )->where('status', '=', 2)->find($id);

        if($rtlh != null)
        {
        	return view('admin.verifikasi-sudah-detail')->with('rtlh', $rtlh);
        }
        else
        {
        	return view('admin.errors/204');
        }
    }
}
