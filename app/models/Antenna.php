<?php

class Antenna extends Eloquent {

	protected $table = 'antenne';

	public function elencoAntenne($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

	public function elencoAntenneDisponibili($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }    

}