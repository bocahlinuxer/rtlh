<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rtlh;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsuperadmin()
    {
        return view('admin.superadmin.mapsgson');
    }

    public function indexperbekel()
    {
        return view('admin.perbekel.mapsgson');
    }

    public function indexverifikasi()
    {
        return view('admin.verifikasi.mapsgson');
    }

    public function ajax_rumah_superadmin()
    {
        $rumah = Rtlh::where('status', '<>' , 0)->get();

        return json_encode($rumah);
    }

    public function ajax_rumah_perbekel()
    {
        $rumah = Rtlh::where('status', '<>' , 0)->where('id_desa', Auth::user()->desa->id_desa)->get();

        return json_encode($rumah);
    }

    public function ajax_rumah_verifikasi()
    {
        $rumah = Rtlh::where('status', '<=' , 2)->get();

        return json_encode($rumah);
    }
}
