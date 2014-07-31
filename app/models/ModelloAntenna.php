<?php

class ModelloAntenna extends Eloquent {

	protected $table = 'modelliAntenna';

	public function Antenna()
	{
		return $this->hasMany('Antenna');
	}
}