<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'kabupaten';
    public $primaryKey = 'id_kabupaten';
    public $timestamps = false;

    public function kecamatan()
    {
    	return $this->hasMany('App\Kecamatan', 'id_kabupaten');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi', 'id_kabupaten');
    }
}
