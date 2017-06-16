<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use Image;
use App\FotoRtlh;
use App\Rtlh;
use Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanFotoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idrtlh)
    {
        return view('admin.perbekel.pengajuanfoto-create')->with('idrtlh', $idrtlh);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idrtlh, Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), FotoRtlh::$rules);

        if ($validator->fails()) {
            return redirect('adminperbekel/pengajuan/'.$idrtlh.'/fotortlh/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        $rtlh = Rtlh::find($idrtlh);

        //buat variable user
        $foto = new FotoRtlh;

        //set rtlh
        $foto->rtlh()->associate($rtlh);

        //set created by
        $foto->created_by_user()->associate($userlogin);

        $foto->save();

        if ($request->file('file_fotortlh')->isValid()) {
            $img = "img-".$foto->id_fotortlh.".".$request->file('file_fotortlh')->getClientOriginalExtension();

            $basepath = public_path().'/img/rtlh/';
            $foto->file_fotortlh = $img;
            
            //intervention image api
            // Image::make($request -> file_fotortlh)
            // ->resize(800, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })
            // ->save($basepath.$img);

            Image::make($request -> file_fotortlh)->save($basepath.$img);

            $foto->save();
        }

        Session::flash('msgsave', 'Tambah Foto Pengajuan RTLH berhasil');
        return redirect('adminperbekel/pengajuan/'.$idrtlh);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idrtlh, $id)
    {
        return view('admin.perbekel.pengajuanfoto-edit')->with(array(
            'idrtlh' => $idrtlh,
            'id' => $id
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($idrtlh, Request $request, $id)
    {
        //validasi
        $validator = Validator::make($request->all(), FotoRtlh::$rules);

        if ($validator->fails()) {
            return redirect('adminperbekel/pengajuan/'.$idrtlh.'/fotortlh/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Proses inputan
        //ambil user yang login
        $userlogin = Auth::user();

        //buat variable user
        $foto = FotoRtlh::find($id);

        //set updated by
        $foto->updated_by_user()->associate($userlogin);

        if ($request->file('file_fotortlh')->isValid()) {
            $img = "img-".$foto->id_fotortlh.".".$request->file('file_fotortlh')->getClientOriginalExtension();

            $basepath = public_path().'/img/rtlh/';
            $foto->file_fotortlh = $img;
            
            //intervention image api
            // Image::make($request -> file_fotortlh)
            // ->resize(800, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })
            // ->save($basepath.$img);

            Image::make($request -> file_fotortlh)->save($basepath.$img);

            $foto->save();
        }

        Session::flash('msgedit', 'Ubah Foto Pengajuan RTLH berhasil');
        return redirect('adminperbekel/pengajuan/'.$idrtlh);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idrtlh, $id)
    {
        //buat variable user
        $foto = FotoRtlh::find($id);
        $foto->delete();

        Session::flash('msgdelete', 'Hapus Foto Pengajuan RTLH berhasil');
        return redirect('adminperbekel/pengajuan/'.$idrtlh);
    }
}
