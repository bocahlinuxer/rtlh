<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'pekerjaan';
    public $primaryKey = 'id_pekerjaan';

    public function rtlh()
    {
    	return $this->hasMany('App\Rtlh', 'id_pekerjaan');
    }

    public function created_by_user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
