<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rtlh;

class MapsController extends Controller
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
        return view('mapsgson');
    }

    public function ajax_rumah()
    {
        $rumah = Rtlh::where('status', '<>' , 0)->get();

        return json_encode($rumah);
    }
}
