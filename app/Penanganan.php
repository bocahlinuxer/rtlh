<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'penanganan';
    public $primaryKey = 'id_penanganan';

    public static $rules = array(
        'foto0' => 'required|image',
        'foto100' => 'required|image'
    );

    public static $updaterules = array(
        'foto0' => 'image',
        'foto100' => 'image'
    );

    public function rtlh()
    {
    	return $this->belongsTo('App\Rtlh', 'id_rtlh');
    }

    public function opd()
    {
        return $this->belongsTo('App\Opd', 'id_rtlh');
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
