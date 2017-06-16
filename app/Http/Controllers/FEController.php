<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rtlh;
use App\Penanganan;

class FEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function rtlh()
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
        )->where('status', 4)->get();
        
        return view('rtlh')->with('rtlh', $rtlh);
    }

    public function program()
    {
    	$rtlh = Rtlh::with(
            [
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
        )->where('status', 4)->get();

        return view('program')->with('rtlh', $rtlh);
    }

    public function lokasi()
    {
    	return view('lokasi');
    }

    public function ajax_rumah()
    {
        $rumah = Rtlh::where('status', 4)->get();

        return json_encode($rumah);
    }

    public function kontak()
    {
        return view('kontak');
    }
}
