<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rtlh;
use App\Pekerjaan;
use App\Opd;
use App\User;
use App\Kecamatan;


class DashboardController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsuperadmin()
    {
        $rtlh = Rtlh::where('status', '<>', 0)->count();
        $usulan = Rtlh::where('status', 1)->count();
        $verifikasi = Rtlh::where('status', 2)->count();
        $penanganan = Rtlh::whereNotNull('penanganan_by')->count();
        $pekerjaan = Pekerjaan::where('status', '<>', 0)->count();
        $opd = Opd::where('status', '<>', 0)->count();
        $adminperbekel = User::where('tipe', 2)->where('status', '<>', 0)->count();
        $adminverifikasi = User::where('tipe', 3)->where('status', '<>', 0)->count();

        return view('admin.superadmin.dashboard')->with(array(
            'rtlh' => $rtlh,
            'usulan' => $usulan,
            'verifikasi' => $verifikasi,
            'penanganan' => $penanganan,
            'pekerjaan' => $pekerjaan,
            'opd' => $opd,
            'adminperbekel' => $adminperbekel,
            'adminverifikasi' => $adminverifikasi
            ));
    }

    public function indexperbekel()
    {
        return redirect('adminperbekel/rtlh');
        return view('admin.perbekel.dashboard');
    }

    public function indexverifikasi()
    {
        return redirect('adminverifikasi/verifikasi');
        return view('admin.verifikasi.dashboard');
    }

    public function indexkepala()
    {
        $rtlh = Rtlh::where('status', '<>', 0)->count();
        $usulan = Rtlh::where('status', 1)->count();
        $verifikasi = Rtlh::where('status', 2)->count();
        $penanganan = Rtlh::whereNotNull('penanganan_by')->count();
        
        //untuk chart
        $kecamatan = Kecamatan::with('desa')->where('status', '<>', 0)->get();

        for ($i=0; $i < $kecamatan->count(); $i++) {
            $jumlahrumah = 0;

            foreach ($kecamatan[$i]->desa as $desa) {
                $jumlahrumah = $jumlahrumah + $desa->rtlh->where('status', '<>', 0)->count();
            }

            $kecamatan[$i]->jumlahrumah = $jumlahrumah;
        }

        return view('admin.kepala.dashboard')->with(array(
            'rtlh' => $rtlh,
            'usulan' => $usulan,
            'verifikasi' => $verifikasi,
            'penanganan' => $penanganan,
            'kecamatan' => $kecamatan
            ));
    }
}
