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
        return $this->select(array('antenne.id', 'modelliAntenna.nome AS modello', 'antenne.mac AS mac', 'antenne.seriale AS seriale' ))
            ->join('modelliAntenna', 'modelliAntenna.id', '=', 'antenne.modelloAntenna_id')
            ->leftJoin('interventi', 'interventi.antenna_id', '=', 'antenne.id')
            ->where('antenne.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '=', '0000-00-00 00:00:00')
            ->where('interventi.user_id', '=', $idUser)
            ->get();
    }

    public function elencoDaTe()
    {
        return $this->select(array('modelliAntenna.nome AS modello', 'antenne.seriale AS seriale', 'antenne.dataRicezione' ))
            ->join('modelliAntenna', 'modelliAntenna.id', '=', 'antenne.modelloAntenna_id')
            ->where('antenne.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
        //    ->where('dataConsegna', '!=', '0000-00-00 00:00:00')
            ->where('magazzino_id', '=', Auth::user()->id)
            ->get();
    }

    public function inMagazzino()
    {
        return $this->select('antenne.id', 'antenne.mac', 'antenne.seriale', 'modelliAntenna.nome', 'antenne.dataRicezione', 'users.username')
            ->join('modelliAntenna', 'modelliAntenna.id', '=', 'antenne.modelloAntenna_id')
            ->leftJoin('interventi', 'interventi.antenna_id', '=', 'antenne.id')
            ->leftJoin('users', 'users.id', '=', 'interventi.user_id')
            ->where('antenne.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '=', '0000-00-00 00:00:00')
            ->where('interventi.user_id', '=', 0)
            ->get();
    }    

    public function totMioMagazzino($userid = 0)
    {
        return $this->select('antenne.id', 'antenne.mac', 'antenne.seriale', 'modelliAntenna.nome', 'antenne.dataRicezione')
            ->join('modelliAntenna', 'modelliAntenna.id', '=', 'antenne.modelloAntenna_id')
            ->leftJoin('interventi', 'interventi.antenna_id', '=', 'antenne.id')
            ->leftJoin('users', 'users.id', '=', 'interventi.user_id')
            ->where('antenne.azienda_id', '=', Auth::user()->azienda_id )
            ->where('dataRicezione', '!=', '0000-00-00 00:00:00')
            ->where('dataConsegna', '!=', '0000-00-00 00:00:00')
            ->where('interventi.user_id', '!=', $userid)
            ->get();
    }    

    public function consegna($id)
    {
        var_dump($elenco); die;
        foreach ($elenco as $riga) {
            $riga->magazzino_id = $id;
            $riga->dataConsegna = date("Y-m-d H:i:s");
            $riga->save();
            echo $riga->modello;
        }
    }

}