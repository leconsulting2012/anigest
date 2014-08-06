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
        return $this->where('azienda_id', '=', $user->azienda_id );
    }  

    public function elencoRoutersMagazzino($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id )->where('dataRicezione', '!=', '0000-00-00 00:00:00')->where('dataMontaggio', '!=', '0000-00-00 00:00:00');
    }     

    public function contaMagazzino()
    {
        return $this->where('azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '=', '0000-00-00 00:00:00')
            ->count()
            ;
    }       

}