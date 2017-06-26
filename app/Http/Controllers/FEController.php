<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rtlh;
use App\FotoRtlh;

class FEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rtlh = Rtlh::whereNotNull('publish_at')->count();
        $penanganan = Rtlh::whereNotNull('publish_at')->where('status', 3)->count();
        $slideshow = FotoRtlh::whereHas('rtlh', function($query){
                        $query->whereNotNull('publish_at');  
                    })->inRandomOrder()->take(5)->get();

        $slideshow2 = Rtlh::whereNotNull('publish_at')->inRandomOrder()->take(5)->get(array('foto100'));

        return view('dashboard')->with(array(
            'rtlh' => $rtlh,
            'penanganan' => $penanganan,
            'slideshow' => $slideshow,
            'slideshow2' => $slideshow2
            ));
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
        )->whereNotNull('publish_at')->get();
        
        return view('rtlh')->with('rtlh', $rtlh);
    }

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
                'foto_rtlh',
                'opd' => function($q)
                {
                    $q->select('id_opd', 'opd');
                },
            ]
        )->whereNotNull('publish_at')->find($id);
    
        return view('rtlh-detail')->with('rtlh', $rtlh);
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
        )->where('status', 3)->whereNotNull('publish_at')->get();

        return view('program')->with('rtlh', $rtlh);
    }

    public function lokasi()
    {
    	return view('lokasi');
    }

    public function ajax_rumah()
    {
        $rumah = Rtlh::whereNotNull('publish_at')->get();

        return json_encode($rumah);
    }

    public function kontak()
    {
        return view('kontak');
    }
}
