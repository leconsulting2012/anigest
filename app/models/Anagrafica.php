<?php

class Anagrafica extends Eloquent {

	protected $table = 'anagrafiche';

	protected $softDelete = true;

	public function elencoAnagrafiche($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

	public function elencoAnagraficheDisponibili($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }	

}