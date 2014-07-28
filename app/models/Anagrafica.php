<?php

class Anagrafica extends Eloquent {

	protected $table = 'anagrafiche';

	protected $softDelete = true;

	public function elencoAnagraficheDisponibili()
    {
        return ;//this->where('azienda_id', '=', $user->azienda_id )->where('interventoOccupato', '!=', 0);
    }	

}