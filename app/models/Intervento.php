<?php

class Intervento extends Eloquent {

	protected $table = 'interventi';

	public function antenna()
	{
		return $this->hasMany('Antenna');
	}

	public function router()
	{
		return $this->hasMany('Router');
	}

	public function anagrafica()
	{
		return $this->hasMany('Anagrafica');
	}

	public function elencoInterventi($user)
    {
        return $this->where('azienda_id', '=', $user->azienda_id );
    }

    public function elencoInterventiPeriodo($dataInizio, $dataFine)
    {
        return DB::table('interventi')
            ->select(array('interventi.id', 'interventi.dataIntervento', 'interventi.dataFineIntervento', 'tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
            ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->join('users','users.id','=', 'interventi.user_id')
            ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
        	->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
        	->where('interventi.dataIntervento', '>=', date("Y-m-d", strtotime($dataInizio)))
        //	->where('interventi.dataIntervento', '<', date("Y-m-d", strtotime($dataFine)))
            ->get()
            ;            	
    }

    public function contaInterventiScoperti()
    {
        return DB::table('interventi')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.dataIntervento', '=', NULL)
        //  ->where('interventi.dataIntervento', '<', date("Y-m-d", strtotime($dataFine)))
            ->count()
            ;               
    }    

    public function elencoInterventiDaCompletare()
    {
        $elenco = DB::table('interventi')
            ->select(array('interventi.id', 'interventi.dataIntervento', 'tipiIntervento.tipo', 'tipiIntervento.id AS idTipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia', 'anagrafiche.telefono'))
            ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->join('users','users.id','=', 'interventi.user_id')
            ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.completato', '=', 0)
            ->orderBy('dataIntervento', 'desc')
            ->get()
            ;

        $elencoNew = array();
        $livelli = array();
        $temp = array();
        $x = 1;

        $livelli[1] = 'navy';
        $livelli[2] = 'aqua';
        $livelli[3] = 'green';
        $livelli[4] = 'yellow';
        $livelli[5] = 'red';                

        foreach ($elenco as $riga) {
            $temp['n'] = $x; $x++;
            $temp['id'] = $riga->id;
            $temp['anagrafica'] = substr( $riga->cognome . " " . $riga->nome . " - " . $riga->indirizzo1 . " " . $riga->citta, 0, 40) . "...";
            $temp['livello'] = $livelli[$riga->idTipo];
            $temp['livTesto'] = substr($riga->tipo, 0,4);
            $temp['telefono'] = $riga->telefono;
            $elencoNew[] = $temp;
        }    
        return $elencoNew;                  
    }


}