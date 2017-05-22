<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'desa';
    public $primaryKey = 'id_desa';
    public $timestamps = false;

    public function rtlh()
    {
    	return $this->hasMany('App\Rtlh', 'id_desa');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan', 'id_kecamatan');
    }
}
