<?php

class Company extends Eloquent implements UserInterface, RemindableInterface {

	public function company()
	{
		return $this->belongsTo('User', 'companie_id');
	}

}