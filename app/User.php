<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The model setting.
     */
    protected $table = 'user';
    public $primaryKey = 'id_user';

    //rules / aturan validasi pada form
    public static $rules = array(
        'nama' => 'required|max:100',
        'username' => 'required|max:50|unique:user',
        'password' => 'required|confirmed|max:100',
        'tipe' => 'required'
    );

    //rules / aturan validasi pada form
    public static $updaterules = array(
        'nama' => 'required|max:100',
        'tipe' => 'required'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'password', 'tipe', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //for logging
    public function created_user()
    {
        return $this->hasMany('App\User');
    }

    public function updated_user()
    {
        return $this->hasMany('App\User');
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
