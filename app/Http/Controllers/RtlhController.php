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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rtlh = Rtlh::getRtlh();
        
        return view('rtlh')->with('rtlh', $rtlh);
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
        return view('rtlh-create')->with(array(
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
            return redirect('rtlh/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        if(Rtlh::saveRtlh($userlogin, $request))
        {
            Session::flash('msgsave', 'Tambah RTLH berhasil');
        }
        else
        {
            Session::flash('msgdelete', 'Tambah RTLH gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rtlh = Rtlh::getRtlhDetail($id);
        
        return view('rtlh-detail')->with('rtlh', $rtlh);
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

        return view('rtlh-edit')->with(array(
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
            return redirect('rtlh/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = Rtlh::updateRtlh($userlogin, $id, $request);
        
        return redirect('rtlh/'.$rtlh->id_rtlh);
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

        if(Rtlh::deleteRtlh($userlogin, $id))
        {
            Session::flash('msgdelete', 'Hapus RTLH berhasil');
        }
        else
        {
            Session::flash('msgdelete', 'Hapus RTLH gagal');
        }
    }
}
