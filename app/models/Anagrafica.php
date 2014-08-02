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

}