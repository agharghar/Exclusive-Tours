<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
	protected $table ='bills';
	protected $fillable =['pu','litrage','num_carte','km','date','bus_id','peage_autoroute','peage_lavage','facture_gazoile_id'];
   


    public function facture()
    {
    	return $this->belongsTo('\App\facture_gazoile','facture_gazoile_id','id');
    }



    public function bus()
    {
    	return $this->belongsTo('\App\bus','bus_id','id');
    }



}
