<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{
    public function faktaintegritas(Request $request)
    {
    	$user = $request->u;
    	$pass = $request->p;

    	$userm = User::where('username', $user)->first();

    	if($user != null)
    	{
    		if (Hash::check($pass, $userm->password)) {
		    	if($userm->tipe == 2)
		    	{
		    		$userm = User::with([
	                'desa' => function($q)
	                {
	                    $q->select('id_desa', 'desa');
	                }
	                ])->where('username', $user)->first();

	                $userx = new \stdClass;
	                $userx->nama = $userm->nama;
	                $userx->desa = $userm->desa->desa;
	                $userx->tipe = $userm->tipe;
		    	}
		    	else
		    	{
		    		$userx = User::where('username', $user)->get(array('nama', 'tipe'))->first();
		    	}
		    	return json_encode($userx);
			}
			else
			{
				return "salah";
			}
    	}
    	else
		{
			return "tidakada";
		}
    }
}
