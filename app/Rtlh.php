<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Rtlh extends Model
{
	/**
     * The model setting.
     */
    protected $table = 'rtlh';
    public $primaryKey = 'id_rtlh';

    public static $rules = array(
        'nama' => 'required|max:100',
        'nik' => 'required|max:20',
        'alamat' => 'required|max:100',
        'jumlah_tanggungan' => 'required|integer',
        'penghasilan' => 'required|integer',
        'luas_rumah' => 'required',
        'kondisi_lantai' => 'required|integer',
        'kondisi_dinding' => 'required|integer',
        'kondisi_atap' => 'required|integer',
        'utilitas_listrik' => 'required|integer',
        'utilitas_air' => 'required|integer',
        'utilitas_mck' => 'required|integer',
        'bukti' => 'required|integer',
        'latitude' => 'required',
        'longitude' => 'required',
        'data_lainnya' => 'max:255'
    );

    public function pekerjaan()
    {
        return $this->belongsTo('App\Pekerjaan', 'id_pekerjaan');
    }    

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'id_desa');
    }

    public function foto_rtlh()
    {
    	return $this->hasMany('App\FotoRtlh', 'id_rtlh');
    }

    public function created_by_user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function verified_by_user()
    {
        return $this->belongsTo('App\User', 'verified_by');
    }

    //method
    public static function getRtlh()
    {
        return Rtlh::with(
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
        )->where('status', '<>', 0)->get();
    }

    public static function getRtlhDetail($id)
    {
        return Rtlh::with(
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
    }

    public static function saveRtlh($userlogin, $request)
    {
        if ($user->can('create', Post::class)) {
            $rtlh = new Rtlh;
            $rtlh->nama = $request->nama;
            $rtlh->nik = $request->nik;
            $rtlh->alamat = $request->alamat;
            $rtlh->jumlah_tanggungan = $request->jumlah_tanggungan;
            $rtlh->penghasilan = $request->penghasilan;
            $rtlh->luas_rumah = $request->luas_rumah;
            $rtlh->id_desa = $request->desa;
            $rtlh->id_pekerjaan = $request->pekerjaan;
            $rtlh->kondisi_lantai = $request->kondisi_lantai;
            $rtlh->kondisi_atap = $request->kondisi_atap;
            $rtlh->kondisi_dinding = $request->kondisi_dinding;
            $rtlh->utilitas_air = $request->utilitas_air;
            $rtlh->utilitas_listrik = $request->utilitas_listrik;
            $rtlh->utilitas_mck = $request->utilitas_mck;
            $rtlh->bukti = $request->bukti;
            $rtlh->latitude = $request->latitude;
            $rtlh->longitude = $request->longitude;
            $rtlh->data_lainnya = $request->data_lainnya;
            $rtlh->status = 1;

            //set created by
            $rtlh->created_by_user()->associate($userlogin);

            //simpan user baru
            $rtlh->save();

            return true;
        }
    }

    public static function updateRtlh($userlogin, $id, $request)
    {
        $rtlh = Rtlh::find($id);

        if($userlogin->can('update', $rtlh))
        {
            $rtlh->nama = $request->nama;
            $rtlh->nik = $request->nik;
            $rtlh->alamat = $request->alamat;
            $rtlh->jumlah_tanggungan = $request->jumlah_tanggungan;
            $rtlh->penghasilan = $request->penghasilan;
            $rtlh->luas_rumah = $request->luas_rumah;
            $rtlh->id_desa = $request->desa;
            $rtlh->id_pekerjaan = $request->pekerjaan;
            $rtlh->kondisi_lantai = $request->kondisi_lantai;
            $rtlh->kondisi_atap = $request->kondisi_atap;
            $rtlh->kondisi_dinding = $request->kondisi_dinding;
            $rtlh->utilitas_air = $request->utilitas_air;
            $rtlh->utilitas_listrik = $request->utilitas_listrik;
            $rtlh->utilitas_mck = $request->utilitas_mck;
            $rtlh->bukti = $request->bukti;
            $rtlh->latitude = $request->latitude;
            $rtlh->longitude = $request->longitude;
            $rtlh->data_lainnya = $request->data_lainnya;

            //set created by
            $rtlh->updated_by_user()->associate($userlogin);

            //simpan user baru
            $rtlh->save();

            Session::flash('msgedit', 'Ubah RTLH berhasil');
            return $rtlh;
        }

        Session::flash('msgdelete', 'Ubah RTLH gagal');
        return $rtlh;
    }

    public static function deleteRtlh($userlogin, $id)
    {
        $rtlh = Rtlh::find($id);

        if($userlogin->can('delete', $rtlh))
        {
            $rtlh->status = 0;

            //set created by
            $rtlh->updated_by_user()->associate($userlogin);

            //simpan user baru
            $rtlh->save();

            return true;
        }
    }
}
