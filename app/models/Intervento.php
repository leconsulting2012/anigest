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

    public function elencoInterventiPeriodo($user, $dataInizio, $dataFine)
    {
        return $this
        	->join('tipiIntervento', 'tipiIntervento.id' , '=', 'interventi.tipiIntervento_id')
        	->where('interventi.azienda_id', '=', $user->azienda_id )
        	->where('interventi.dataIntervento', '>=', date("Y-m-d", strtotime($dataInizio)))
        	->where('interventi.dataIntervento', '<=', date("Y-m-d", strtotime($dataFine)))
        	->select('interventi.id', 'interventi.dataIntervento', 'tipiIntervento.tipo')
        	->get();    	
    }

}