<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'opd';
    public $primaryKey = 'id_opd';

    // public static $rules = array(
    //     'foto0' => 'required|image',
    //     'foto100' => 'required|image'
    // );

    public function penanganan()
    {
    	return $this->hasMany('App\Penanganan', 'id_opd');
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
