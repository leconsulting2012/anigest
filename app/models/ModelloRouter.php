<?php

class ModelloRouter extends Eloquent {

	protected $table = 'modelliRouter';

	public function Router()
	{
		return $this->hasMany('Router');
	}
}