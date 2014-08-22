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
	public function getIndex()
	{
        // Title
        $title = "Mappa degli Interventi";

        if ((Auth::user()->hasRole('gestore')) or (Auth::user()->hasRole('admin'))) {
            $p = DB::table('interventi')
                ->select(array('tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
                ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
                ->join('users','users.id','=', 'interventi.user_id')
                ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
                ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
                ->where('interventi.completato', '!=', '1' )
                ->get()
            ;            
        }

        if (Auth::user()->hasRole('installatore')) {
            $p = DB::table('interventi')
                ->select(array('tipiIntervento.tipo', 'users.username', 'anagrafiche.nome', 'anagrafiche.cognome', 'anagrafiche.lat', 'anagrafiche.lon', 'anagrafiche.indirizzo1', 'anagrafiche.indirizzo2', 'anagrafiche.citta', 'anagrafiche.provincia'))
                ->join('anagrafiche','anagrafiche.id','=', 'interventi.anagrafica_id')
                ->join('users','users.id','=', 'interventi.user_id')
                ->join('tipiIntervento', 'tipiIntervento.id', '=', 'interventi.tipiIntervento_id')
                ->where('interventi.azienda_id', '=', Auth::user()->azienda_id )
                ->where('interventi.user_id', '=', Auth::user()->id )
                ->where('interventi.completato', '!=', '1' )
                ->get()
            ;            
        }

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
            return View::make('mappe/index', compact('title', 'elenco'));
        }


	}

    public function getEventi()
    {
        $user = Auth::user();
        $interventi = new Intervento;
        $elenco = $interventi->elencoInterventiPeriodo($user, Input::get('start'), Input::get('end') );
        $elencoNew = array();
        $temp = array();

        foreach ($elenco as $riga) {
            $temp['id'] = $riga['id'];
            $temp['title'] = $riga['tipo'];
            $temp['start'] = $riga['dataIntervento'];
            $temp['allDay'] = false;
            $elencoNew[] = $temp;
        }

        return Response::json($elencoNew);
      //  var_dump($elenco);
     //   return json($elenco);
    }


}