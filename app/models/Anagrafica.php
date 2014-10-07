<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Anagrafica extends Eloquent {
   // use SoftDeletingTrait;
	protected $table = 'anagrafiche';


	protected $softDelete = true;

	public function elencoAnagrafiche($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

	public function elencoAnagraficheDisponibili($user)
    {
        return $this->where('azienda_id', '=', Auth::user()->azienda_id );
    }	

    public function interventiDa($user)
    {
        return DB::table('interventi')
                ->select(array('interventi.id', 'interventi.dataAssegnazione', 'interventi.completato AS stato', 'interventi.dataIntervento', 'tipiIntervento.tipo AS tipoIntervento', 'users.username AS installatore'))
                ->leftJoin('users','users.id','=', 'interventi.user_id')
                ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
                ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
                ->where('anagrafica_id', $user->id)
                ->get();

    }       

}