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

    public function daConsegnareUtente($idUser)
    {
        return $this->select(array('routers.id', 'modelliRouter.nome AS modello', 'routers.mac AS mac', 'routers.seriale AS seriale' ))
            ->join('modelliRouter', 'modelliRouter.id', '=', 'routers.modelliRouter_id')
            ->leftJoin('interventi', 'interventi.router_id', '=', 'routers.id')
            ->where('routers.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '=', '0000-00-00 00:00:00')
            ->where('interventi.user_id', '=', $idUser)
            ->get();
    }    

    public function elencoDaTe()
    {
        return $this->select(array('modelliRouter.nome AS modello', 'routers.seriale AS seriale', 'routers.dataRicezione' ))
            ->join('modelliRouter', 'modelliRouter.id', '=', 'routers.modelliRouter_id')
            ->where('routers.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
        //    ->where('dataConsegna', '!=', '0000-00-00 00:00:00')
            ->where('magazzino_id', '=', Auth::user()->id)
            ->get();
    }

    public function inMagazzino()
    {
        return $this->select('routers.id', 'routers.mac', 'routers.seriale', 'modelliRouter.nome', 'routers.dataRicezione', 'users.username')
            ->join('modelliRouter', 'modelliRouter.id', '=', 'routers.modelliRouter_id')
            ->leftJoin('interventi', 'interventi.router_id', '=', 'routers.id')
            ->leftJoin('users', 'users.id', '=', 'interventi.user_id')
            ->where('routers.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '=', '0000-00-00 00:00:00')
            ->where('interventi.user_id', '=', 0)
            ->get();
    }

    public function totMioMagazzino($userid = 0)
    {
        return $this->select('routers.id', 'routers.mac', 'routers.seriale', 'modelliRouter.nome', 'routers.dataRicezione')
            ->join('modelliRouter', 'modelliRouter.id', '=', 'routers.modelliRouter_id')
            ->leftJoin('interventi', 'interventi.router_id', '=', 'routers.id')
            ->where('routers.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '!=', '0000-00-00 00:00:00')
            ->where('interventi.user_id', '!=', $userid)
            ->get();
    }


}