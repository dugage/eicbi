<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class Alerts
{
	//retorna true or false según el resutlado de la consulta
	//$model le pasa el modelo o tabla para la consulta
    public static function getAlert($model)
	{
		//booleano, retorna true or false, inicializado como false
		$result = false;
		//almacena la consulta
		$query = null;
		//realizamos la consulta en función del modelo
		switch ($model) {
			case 'Webminar':

				$query = DB::table('webminars')
				->where('start_date','<=',date('dmY'))
        		->where( 'start_hour','>',date('Hi'))
        		->count();

				break;
			
			default:
				# code...
				break;
		}
		//comprabamos si el query > 0, y si es así, sobreescribimos result a true
		if( $query > 0 )
			$result = true;

		return $result;
	}
}