<?php

class CalendariController extends \BaseController {

    protected $intervento;

    public function __construct(Intervento $intervento)
    {
        parent::__construct();
        $this->intervento = $intervento;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        // Title
        $title = "Calendario";

        return View::make('calendari/index', compact('title'));
	}

    public function getEventi()
    {
        $user = Auth::user();
        $interventi = new Intervento;

        if ((Auth::user()->hasRole('gestore')) or (Auth::user()->hasRole('admin'))) { 
            $elenco = $interventi->elencoInterventiPeriodo('gestore', Input::get('start'), Input::get('end') );
        }
        if (Auth::user()->hasRole('installatore')) {
            $elenco = $interventi->elencoInterventiPeriodo('installatore' , Input::get('start'), Input::get('end') );
        }


        $elencoNew = array();
        $temp = array();

        foreach ($elenco as $riga) {
            $temp['id'] = $riga->id;
            $temp['title'] = $riga->tipo . " - " . $riga->cognome . " " . $riga->nome;
            $temp['start'] = $riga->dataIntervento;
            $temp['end'] = $riga->dataFineIntervento;
            $temp['allDay'] = false;
            $temp['editable'] = true;
        //    $temp['url'] = "http://www.google.it/";
            $temp['description'] = 'prova';

            $temp['backgroundColor'] = "#0073b7"; //Blue
            $temp['borderColor'] = "#0073b7"; //Blue

            $elencoNew[] = $temp;
        }
        return Response::json($elencoNew);
    }

    public function updateEvento()
    {
        $user = Auth::user();
        $i = new Intervento;
        $intervento = $i->find((int)Input::get('id'));


        // Modifico il formato delle date
        $format = 'Y-m-d H:i:s';
        $new = str_replace("T", " ", Input::get('data'));
        $date = DateTime::createFromFormat($format, $new);

        if($date != FALSE){
            $intervento->dataIntervento = $date->format('Y-m-d H:i');     
            $intervento->dataFineIntervento = $date->add(new DateInterval('PT3H'));
        }    
        if($intervento->save()){

        } else {
            
        }
    }
}