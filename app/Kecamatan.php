<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'kecamatan';
    public $primaryKey = 'id_kecamatan';
    public $timestamps = false;

    public function desa()
    {
    	return $this->hasMany('App\Desa', 'id_kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo('App\Kabupaten', 'id_kecamatan');
    }
}
