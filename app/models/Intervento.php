<?php

class Intervento extends Eloquent {

	protected $table = 'interventi';

	public function antenna()
	{
		return $this->hasMany('Antenna');
	}

	public function router()
	{
		return $this->hasMany('Router');
	}

	public function anagrafica()
	{
		return $this->hasMany('Anagrafica');
	}

	public function elencoInterventi($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

    public function elencoInterventiPeriodo($dataInizio, $dataFine)
    {
        return DB::table('interventi')
            ->select(array('interventi.id', 'interventi.dataIntervento', 'tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
            ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->join('users','users.id','=', 'interventi.user_id')
            ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
        	->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
        	->where('interventi.dataIntervento', '>=', date("Y-m-d", strtotime($dataInizio)))
        //	->where('interventi.dataIntervento', '<', date("Y-m-d", strtotime($dataFine)))
            ->get()
            ;            	
    }

}