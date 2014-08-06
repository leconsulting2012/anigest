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

}