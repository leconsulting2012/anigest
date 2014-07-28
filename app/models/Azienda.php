<?php

class Azienda extends Eloquent {

	protected $table = 'aziende';

	public function User()
	{
		return $this->hasMany('User');
	}

	public function antenna()
	{
		return $this->hasMany('Antenna');
	}

	public function intervento()
	{
		return $this->hasMany('Interventi');
	}			

	public function anagrafica()
	{
		return $this->hasMany('Anagrafica');
	}	
}