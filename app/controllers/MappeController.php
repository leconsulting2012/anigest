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

        $p = DB::table('anagrafiche')
            ->where('azienda_id', '=', Auth::user()->azienda_id )
            ->get();
            ; 
        

        $elenco = array();
        $temp = array();

        foreach ($p as $riga ) {
            if ($riga->lat != 0)
            {
                $temp['nominativo'] = $riga->cognome." ".$riga->nome;
                $temp['descrizione'] = 'prova';
                $temp['indirizzo'] = $riga->indirizzo1." ".$riga->indirizzo2." ";
                $temp['citta'] = $riga->citta." (".$riga->provincia.")";
                $temp['lat']=$riga->lat;
                $temp['lon']=$riga->lon;

                $elenco[] = $temp;
            }

        }

        return View::make('mappe/index', compact('title', 'elenco'));
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