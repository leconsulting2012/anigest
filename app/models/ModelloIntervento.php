<?php

class ModelloIntervento extends Eloquent {

	protected $table = 'tipiIntervento';

	public function Intervento()
	{
		return $this->hasMany('Intervento');
	}
}