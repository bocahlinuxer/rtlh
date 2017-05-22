<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'data_lainnya' => 'required',
        'status' => 'required|integer'
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
}
