<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsuperadmin()
    {
        return view('admin.superadmin.dashboard');
    }

    public function indexperbekel()
    {
        return view('admin.perbekel.dashboard');
    }

    public function indexverifikasi()
    {
        return view('admin.verifikasi.dashboard');
    }

    public function indexkepala()
    {
        return view('admin.dashboard');
    }
}
