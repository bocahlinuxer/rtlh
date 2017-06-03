<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoRtlh extends Model
{
    /**
     * The model setting.
     */
    protected $table = 'fotortlh';
    public $primaryKey = 'id_fotortlh';

    public static $rules = array(
        'file_fotortlh' => 'required|image'
    );

    public function rtlh()
    {
        return $this->belongsTo('App\Rtlh', 'id_rtlh');
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
