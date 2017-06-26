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
use Carbon\Carbon;

class PenangananController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editkepala($id)
    {
        $opd = Opd::where('status', '<>', 0)->get();
        $rtlh = Rtlh::with('opd')->find($id);

        //return json_encode($rtlh);

        return view('admin.kepala.verifikasi-penanganan-edit')->with(array(
            'id' => $id,
            'opd' => $opd,
            'rtlh' => $rtlh
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatekepala(Request $request, $id)
    {
        //validasi
        $validator = Validator::make($request->all(), array(
            "foto0" => 'image',
            "foto100" => 'image'
            ));

        if ($validator->fails()) {
            return redirect('adminkepala/rtlh/'.$id.'/program')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = Rtlh::find($id);
        $opd = Opd::find($request->id_opd);

        //set opd
        $rtlh->opd()->associate($opd);

        $rtlh->status = 3;

        //set created by
        $rtlh->penanganan_by_user()->associate($userlogin);
        $rtlh->penanganan_at = Carbon::now();

        $rtlh->save();

        if ($request->hasFile('foto0')) {
            if ($request->file('foto0')->isValid()) {
                $img = "img0-".$rtlh->id_rtlh.".".$request->file('foto0')->getClientOriginalExtension();

                $basepath = public_path().'/img/penanganan/';
                $rtlh->foto0 = $img;
                
                //intervention image api
                // Image::make($request -> file_fotortlh)
                // ->resize(800, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // })
                // ->save($basepath.$img);

                Image::make($request -> foto0)->save($basepath.$img);

                $rtlh->save();
            }
        }

        if ($request->hasFile('foto100')) {
            if ($request->file('foto100')->isValid()) {
                $img = "img100-".$rtlh->id_rtlh.".".$request->file('foto100')->getClientOriginalExtension();

                $basepath = public_path().'/img/penanganan/';
                $rtlh->foto100 = $img;
                
                //intervention image api
                // Image::make($request -> file_fotortlh)
                // ->resize(800, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // })
                // ->save($basepath.$img);

                Image::make($request -> foto100)->save($basepath.$img);

                $rtlh->save();
            }
        }

        Session::flash('msgedit', 'Penanganan RTLH berhasil');
        return redirect('adminkepala/rtlh/'.$id);
    }

    public function publishkepala($id)
    {
        //ambil user yang login
        $userlogin = Auth::user();

        //buat variable user
        $rtlh = Rtlh::find($id);

        //set created by
        $rtlh->publish_at = Carbon::now();
        $rtlh->published_by_user()->associate($userlogin);

        //simpan user baru
        $rtlh->save();

        Session::flash('msgedit', 'publish RTLH berhasil');
        return redirect('adminkepala/rtlh/'.$rtlh->id_rtlh);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekapsuperadmin()
    {
        $rtlh = Rtlh::with(
            [
                'penanganan_by_user' => function($q)
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
                },
                'opd' => function($q)
                {
                    $q->select('id_opd', 'opd');
                }
            ]
        )->where('status', '>=', 3)->get();

        return view('admin.superadmin.rekap-penanganan')->with('rtlh', $rtlh);
    }

    public function rekapperbekel()
    {
        $rtlh = Rtlh::with(
            [
                'penanganan_by_user' => function($q)
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
                },
                'opd' => function($q)
                {
                    $q->select('id_opd', 'opd');
                }
            ]
        )->where('status', '>=', 3)->where('id_desa', Auth::user()->desa->id_desa)->get();

        return view('admin.perbekel.rekap-penanganan')->with('rtlh', $rtlh);
    }

    public function rekapkepala()
    {
        $rtlh = Rtlh::with(
            [
                'penanganan_by_user' => function($q)
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
                },
                'opd' => function($q)
                {
                    $q->select('id_opd', 'opd');
                }
            ]
        )->where('status', '>=', 3)->get();

        return view('admin.kepala.rekap-penanganan')->with('rtlh', $rtlh);
    }
}
