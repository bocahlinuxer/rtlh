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

    public function rtlh()
    {
    	return $this->hasMany('App\Rtlh', 'id_opd');
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
