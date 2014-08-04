<?php

class CittaController extends \BaseController {

    public function __construct()
    {
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $term = filter_input (INPUT_GET, 'term', FILTER_SANITIZE_STRING);
        $p = DB::table('comuniItaliani')->where('denIta', 'LIKE', "%$term%")->lists('denIta')->limit(10) ; 
        return Response::json($p);
       // var_dump($p); die;
       // return json_encode( array('pippo', 'pluto', 'paterino'));

       // return $citta;
    }
}