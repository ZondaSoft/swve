<?php
 // Grupos de vehiculos
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Veh007 extends Model
{
    protected $guarded = ['id','_token' ]; // every field to protect

    // Scope usado en las busquedas
    public function scopeName($query, $name)
  	{
  		// dd("scope :" . $name);

  		if ($name != "")
  		{
  			$query->where(\DB::raw("CONCAT(codigo,' ', detalle )"), "LIKE" , "%$name%");

  			//dd($query);
  		}
  	}
}
