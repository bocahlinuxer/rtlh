<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'provinsi';
    public $primaryKey = 'id_provinsi';
    public $timestamps = false;

    public function kabupaten()
    {
    	return $this->hasMany('App\Kabupaten', 'id_provinsi');
    }
}
