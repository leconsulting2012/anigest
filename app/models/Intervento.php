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

    public function elencoInterventiPeriodo($ruolo = 'installatore', $dataInizio, $dataFine)
    { if (Auth::user()->can("modificare_intervento"))
        { 
        return DB::table('interventi')
            ->select(array('interventi.id', 'interventi.dataIntervento', 'interventi.dataFineIntervento', 'tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
            ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->leftJoin('users','users.id','=', 'interventi.user_id')
            ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.dataIntervento', '>=', date("Y-m-d", strtotime($dataInizio)))
        //  ->where('interventi.completato', '!=', 1)
            ->get()
            ; 
        }
        else
        {
        return DB::table('interventi')
            ->select(array('interventi.id', 'interventi.dataIntervento', 'interventi.dataFineIntervento', 'tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
            ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->leftJoin('users','users.id','=', 'interventi.user_id')
            ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.dataIntervento', '>=', date("Y-m-d", strtotime($dataInizio)))
            ->where('interventi.user_id', '=', Auth::user()->id)
            ->get()
            ; 
        }           	
    }

    public function contaInterventiScoperti()
    {
        return DB::table('interventi')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.dataIntervento', '=', NULL)
            ->where('interventi.completato', '!=', 1)
        //  ->where('interventi.dataIntervento', '<', date("Y-m-d", strtotime($dataFine)))
            ->count()
            ;               
    }    

    public function contaInterventiNonAssegnati()
    {
        return DB::table('interventi')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.user_id', '=', '0')
            ->where('interventi.completato', '!=', 1)
            ->count()
            ;               
    }   

    public function elencoIntrventiIndex(){
        $interventi = Intervento::select(array('interventi.id', 'anagrafiche.cognome as cognome', 'anagrafiche.nome as nome', 'anagrafiche.indirizzo1', 'citta', 'interventi.dataAssegnazione', 'users.username', 'interventi.dataIntervento', 'tipiIntervento.tipo', 'interventi.completato'))
                    ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
                    ->join('users','users.id','=', 'interventi.user_id')
                    ->join('tipiIntervento','tipiIntervento.id','=', 'interventi.tipiIntervento_id')
                    ->where('interventi.azienda_id', '=', Auth::user()->azienda_id)
                    ->get();

        $temp = array();
        $elenco = array();

        foreach ($interventi as $riga) {
            $temp['id'] = $riga->id;
            $temp['nominativo'] = $riga->cognome." ".$riga->nome;
            $temp['installatore'] = $riga->username."<br>Assegnato il ".$riga->dataAssegnazione;
            $temp['dataIntervento'] = $riga->dataIntervento;
            if($riga->dataIntervento == '0000-00-00 00:00:00')
            {
                $temp['completato'] = '';
            } else 
            {
                if ($riga->completato == 0)
                {
                    $temp['completato'] = "<center><a href=\"". URL::to('interventi/') . $riga->id . "/chiudi\" class=\"iframe\"><span class=\"glyphicon glyphicon-thumbs-down\"></span></a></center>";
                } else
                {
                    $temp['completato'] = "<center><span class=\"glyphicon glyphicon-thumbs-up\"></span></a></center>";
                }
            }
            $temp['azioni'] = '<a href="'. URL::to('interventi/') . $riga->id . '/edit" class="btn btn-default btn-xs iframe" >Modifica</a>
                <a href="'. URL::to('interventi/') . $riga->id . '/delete" class="btn btn-xs btn-danger iframe">Elimina</a>';
            $elenco[] = $temp;
        }
    }

    public function elencoInterventiDaCompletare($ruolo = 'installatore')
    {
        if (($ruolo == 'admin') or ($ruolo == 'gestore'))
        {
            $elenco = DB::table('interventi')
                ->select(array('interventi.id', 'interventi.dataIntervento', 'tipiIntervento.tipo', 'tipiIntervento.id AS idTipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia', 'anagrafiche.telefono', 'anagrafiche.cellulare'))
                ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
                ->leftJoin('users','users.id','=', 'interventi.user_id')
                ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
                ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
                ->where('interventi.completato', '=', 0)
                ->orderBy('dataIntervento', 'desc')
                ->get()
                ;            
        }
        if (($ruolo == 'installatore'))
        {
            $elenco = DB::table('interventi')
                ->select(array('interventi.id', 'interventi.dataIntervento', 'tipiIntervento.tipo', 'tipiIntervento.id AS idTipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia', 'anagrafiche.telefono', 'anagrafiche.cellulare'))
                ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
                ->leftJoin('users','users.id','=', 'interventi.user_id')
                ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
                ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
                ->where('interventi.completato', '=', 0)
                ->where('interventi.user_id', '=', Auth::user()->id)
                ->orderBy('dataIntervento', 'desc')
                ->get()
                ;            
        }

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
            $temp['cellulare'] = $riga->cellulare;
            if ($riga->dataIntervento == '0000-00-00 00:00:00')
            {
                $temp['dataIntervento'] = 'Non Programmato!';
            } else
                $temp['dataIntervento'] = $riga->dataIntervento;            {
            }
            $temp['indirizzo'] = $riga->indirizzo1.' '.$riga->indirizzo2;
            $temp['citta'] = $riga->citta;
            $temp['tipo'] = $riga->tipo;
            $temp['cognome'] = $riga->cognome;
            $temp['nome'] = $riga->nome;
            
            $elencoNew[] = $temp;
        }    
        return $elencoNew;                  
    }


}