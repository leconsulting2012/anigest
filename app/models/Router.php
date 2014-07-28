<?php

class Router extends Eloquent {

	protected $table = 'routers';

	protected $softDelete = true;

	public function elencoRouters($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

	public function elencoRoutersDisponibili($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id )->where('intervento_id', '!=', 0);
    }    

}