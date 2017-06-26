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
        'nik' => 'required|digits_between:1,20',
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
        'jenis_penanganan' => 'max:255',
        'sumber_data' => 'max:255',
        'data_lainnya' => 'max:255'
    );

    public static $messages = [
        'required'  => ':attribute harus isi.',
        'size'      => 'The :attribute must be exactly :size.',
        'between'   => 'The :attribute must be between :min - :max.',
        'in'        => 'The :attribute must be one of the following types: :values',
    ];

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

    public function opd()
    {
        return $this->belongsTo('App\Opd', 'id_opd');
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

    public function penanganan_by_user()
    {
        return $this->belongsTo('App\User', 'penanganan_by');
    }

    public function published_by_user()
    {
        return $this->belongsTo('App\User', 'publish_by');
    }
}
