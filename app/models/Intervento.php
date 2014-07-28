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

}