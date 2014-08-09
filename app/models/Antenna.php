<?php

class Antenna extends Eloquent {

	protected $table = 'antenne';

	public function elencoAntenne($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

	public function elencoAntenneMagazzino($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id )->where('dataRicezione', '!=', '0000-00-00 00:00:00')->where('dataMontaggio', '!=', '0000-00-00 00:00:00');
    }    

    public function elencoAntenneDisponibili($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
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
        return $this->select(array('modelliAntenna.nome AS modello', 'antenne.mac AS mac', 'antenne.seriale AS seriale' ))
                    ->join('interventi', 'interventi.antenna_id', '=', 'antenne.id')
                    ->join('modelliAntenna', 'modelliAntenna.id', '=', 'antenne.modelloAntenna_id')
               //
                    ->where('interventi.user_id', '=', $idUser)
                    ->get();
    }

}