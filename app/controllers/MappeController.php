<?php

class MappeController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getTutti()
	{
        // Title
        $title = "Mappa degli Interventi";
        $subTitle = "Elenco di tutti gli Interventi";        


        $p = DB::table('interventi')
            ->select(array('tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
            ->Join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->Join('users','users.id','=', 'interventi.user_id')
            ->Join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.completato', '!=', '1' )
            ->get()
        ;            

        $elenco = array();
        $temp = array();

        foreach ($p as $riga ) {
            if ($riga->lat != 0)
            {
                $temp['nominativo'] = $riga->cognome." ".$riga->nome;
                if ($riga->username == '-')
                {
                    $temp['descrizione'] = $riga->tipo . " da assegnare"; 
                } else
                {
                    $temp['descrizione'] = $riga->tipo . " in carico a ". $riga->username;
                }
                $temp['indirizzo'] = $riga->indirizzo1." ".$riga->indirizzo2." ";
                $temp['citta'] = $riga->citta." (".$riga->provincia.")";
                $temp['lat']=$riga->lat;
                $temp['lon']=$riga->lon;

                $elenco[] = $temp;
            }

        }

        if (count($elenco) == 0) {
            return View::make('mappe/noResults', compact('title'));            
        } else {
            return View::make('mappe/index', compact('title', 'elenco', 'subTitle'));
        }


	}


    public function getTuoi()
    {
        // Title
        $title = "Mappa degli Interventi";
        $subTitle = "Elenco dei tuoi Interventi";

        $p = DB::table('interventi')
            ->select(array('tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
            ->Join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
            ->Join('users','users.id','=', 'interventi.user_id')
            ->Join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
            ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
            ->where('interventi.user_id', '=', Auth::user()->id )
            ->where('interventi.completato', '!=', '1' )
            ->get()
        ;            


        $elenco = array();
        $temp = array();

        foreach ($p as $riga ) {
            if ($riga->lat != 0)
            {
                $temp['nominativo'] = addslashes($riga->cognome)." ".addslashes($riga->nome);
                if ($riga->username == '-')
                {
                    $temp['descrizione'] = $riga->tipo . " da assegnare"; 
                } else
                {
                    $temp['descrizione'] = $riga->tipo . " in carico a ". $riga->username;
                }
                $temp['indirizzo'] = addslashes($riga->indirizzo1)." ".($riga->indirizzo2)." ";
                $temp['citta'] = addslashes($riga->citta)." (".$riga->provincia.")";
                $temp['lat']=$riga->lat;
                $temp['lon']=$riga->lon;

                $elenco[] = $temp;
            }

        }

        if (count($elenco) == 0) {
            return View::make('mappe/noResults', compact('title'));            
        } else {
            return View::make('mappe/index', compact('title', 'elenco', 'subTitle'));
        }


    }



}