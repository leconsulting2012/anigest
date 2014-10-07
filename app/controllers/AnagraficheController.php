<?php

class AnagraficheController extends \BaseController {
    /**
     * Anagrafica Model
     * @var Anagrafica
     */
    protected $anagrafica;

    public function __construct(Anagrafica $anagrafica )
    {
        parent::__construct();

        $this->anagrafica = $anagrafica;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        // Title
        $title = Lang::get('user/anagrafiche/title.gestione_anagrafiche');

        // Grabbo tutti le anagrafiche dell'utente
        $anagrafiche = $this->anagrafica;

        // Show the page
        return View::make('anagrafiche/index', compact('anagrafiche', 'title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('user/anagrafiche/title.create_a_new_anagrafica');

        // Mode
        $mode = 'create';

        $abilitaModifica = ''; 
        $interventi = array();                      

        // Show the page
        return View::make('anagrafiche/create_edit', compact('title', 'mode', 'abilitaModifica', 'interventi'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{

        // Declare the rules for the form validation
        $rules = array(
            'cognome'   => 'required|min:2|max:80',
            'nome'   => 'min:2|max:80',
            'indirizzo1'   => 'min:2|max:80',
            'indirizzo2'   => 'min:2|max:80',
            'cap'   => 'min:5|max:8',
            'citta'   => 'min:2|max:50',
            'provincia'   => 'min:2|max:80',
            'telefono'   	=> 'min:2|max:80',
            'fax'   		=> 'min:2|max:80',
            'cellulare'   => 'min:2|max:50',
            'cfiscale'   => 'min:16|max:16|alpha_dash',
            'piva'   => 'numeric',
            'email'   => 'email'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new antenna
            $user = Auth::user();

            // Update the antenna data
            $this->anagrafica->cognome 				= strtoupper(Input::get('cognome'));
            $this->anagrafica->nome 				= ucwords(strtolower(Input::get('nome')));
            $this->anagrafica->indirizzo1  			= ucwords(strtolower(Input::get('indirizzo1')));
            $this->anagrafica->indirizzo2  			= ucwords(strtolower(Input::get('indirizzo2')));
            $this->anagrafica->cap       			= Input::get('cap');
            $this->anagrafica->citta 				= maiuscolo(Input::get('citta'));
            $this->anagrafica->provincia    		= ucwords(strtolower(Input::get('provincia')));
            $this->anagrafica->telefono    			= Input::get('telefono');
            $this->anagrafica->fax    				= Input::get('fax');
            $this->anagrafica->cellulare    		= Input::get('cellulare');
            $this->anagrafica->cfiscale    			= Input::get('cfiscale');
            $this->anagrafica->piva    				= Input::get('piva');                                    
            $this->anagrafica->email    			= Input::get('email');             
            $this->anagrafica->azienda_id          = Auth::user()->azienda_id;

            // Was the antenna created?
            if($this->anagrafica->save())
            {
                // Redirect to the new antenna page
                return Redirect::to('anagrafiche/' . $this->anagrafica->id . '/edit')->with('success', Lang::get('user/anagrafiche/messages.create.success'));
            }

            // Redirect to the antenna page
            return Redirect::to('anagrafiche/create')->with('error', Lang::get('user/anagrafiche/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('anagrafiche/create')->withInput()->withErrors($validator);
	
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $antenna
     * @return Response
     */
    public function postEdit($anagrafica)
    {
        // Declare the rules for the form validation
        $rules = array(
            'cognome'   => 'required|min:2|max:50',
            'nome'   => 'min:2|max:50',
            'indirizzo1'   => 'min:2|max:50',
            'indirizzo2'   => 'min:2|max:50',
            'cap'   => 'min:5|max:8',
            'citta'   => 'min:2|max:50',
            'provincia'   => 'min:2|max:50',
            'telefono'      => 'min:2|max:50',
            'fax'           => 'min:2|max:50',
            'cellulare'   => 'min:2|max:50',
            'cfiscale'   => 'min:16|max:16|alpha_dash',
            'piva'   => 'numeric',
            'email'   => 'email'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {

            $oldanagrafica = clone $anagrafica;
            $anagrafica->cognome              = strtoupper(Input::get('cognome'));
            $anagrafica->nome                 = ucwords(strtolower(Input::get('nome')));
            $anagrafica->indirizzo1           = ucwords(strtolower(Input::get('indirizzo1')));
            $anagrafica->indirizzo2           = ucwords(strtolower(Input::get('indirizzo2')));
            $anagrafica->cap                  = Input::get('cap');
            $anagrafica->citta                = maiuscolo(Input::get('citta'));
            $anagrafica->provincia            = ucwords(strtolower(Input::get('provincia')));
            $anagrafica->telefono             = Input::get('telefono');
            $anagrafica->fax                  = Input::get('fax');
            $anagrafica->cellulare            = Input::get('cellulare');
            $anagrafica->cfiscale             = Input::get('cfiscale');
            $anagrafica->piva                 = Input::get('piva');                                    
            $anagrafica->email                = Input::get('email'); 
            $anagrafica->azienda_id           = Auth::user()->azienda_id;

            // Was the antenna created?
            if($anagrafica->save()){
                 return Redirect::to('anagrafiche/' . $anagrafica->id . '/edit')->with('success', 'Anagrafica modificata correttamente.');
            }
            return Redirect::to('anagrafiche/' . $anagrafica->id . '/edit')->with('error', Lang::get('users/anagrafiche/messages.edit.error'))->withInput()->withErrors($validator);
        
        } else {
            return Redirect::to('anagrafiche/' . $anagrafica->id . '/edit')->with('error', Lang::get('users/anagrafiche/messages.edit.error'))->withInput()->withErrors($validator);

        }
    } 

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($anagrafica)
	{
        // Title
        $title = Lang::get('user/anagrafiche/title.anagrafica_update');    

        // Mode
        $mode = 'edit';     

        $user = User::where('username','=', Auth::user()->username)->first();
        if ($user->can("modificare_anagrafiche")) {
            $abilitaModifica = '' ;            
        } else {
            $abilitaModifica = 'disabled';
        }
  
        $interventi = array();
        $interventi = $anagrafica->interventiDa($anagrafica);

        // Show the page
        return View::make('anagrafiche/create_edit', compact('anagrafica', 'title', 'mode', 'abilitaModifica', 'interventi'));
	}

    public function getDelete($anagrafica)
    {
        // Title
        $title = Lang::get('user/anagrafiche/title.anagrafiche_delete');

        // Show the page
        return View::make('anagrafiche/delete', compact('anagrafica', 'title'));
    }    

    public function postDelete($anagrafica)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $anagrafica->id;
            $anagrafica->delete();

            // Was the blog post deleted?
            $anagrafica = anagrafica::find($id);
            if(empty($anagrafica))
            {
                // Redirect to the blog posts management page
                return Redirect::to('anagrafiche')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('anagrafiche')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    } 




    public function getData()
    {
        if ((Auth::user()->hasRole('gestore')) or (Auth::user()->hasRole('admin'))) {

            $anagrafiche = Anagrafica::select(array('anagrafiche.id', 'anagrafiche.cognome', 'anagrafiche.nome', DB::raw('CONCAT(anagrafiche.indirizzo1," - ",anagrafiche.citta) as indirizzo'), 'anagrafiche.updated_at'))
            ->where('anagrafiche.azienda_id', '=', Auth::user()->azienda_id);
                               //  ->join('modelliAntenna','modelliAntenna.id','=', 'anagrafiche.modelloAntenna_id');            
            return Datatables::of($anagrafiche)      

            ->edit_column('updated_at', '{{ formato($updated_at) }}') 
            ->add_column('actions', '<a href="{{{ URL::to(\'anagrafiche/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'anagrafiche/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
                ')
            ->remove_column('id')
            ->make();
        }
        if (Auth::user()->hasRole('installatore')) {

            $anagrafiche = Anagrafica::select(array('anagrafiche.id', 'anagrafiche.cognome', 'anagrafiche.nome', DB::raw('CONCAT(anagrafiche.indirizzo1," - ",anagrafiche.citta) as indirizzo'), 'anagrafiche.updated_at'))
                ->join('interventi','interventi.anagrafica_id','=', 'anagrafiche.id')
                ->where('interventi.user_id', '=', Auth::user()->id)
                ->where('anagrafiche.azienda_id', '=', Auth::user()->azienda_id)
            ;
                               //  ->join('modelliAntenna','modelliAntenna.id','=', 'anagrafiche.modelloAntenna_id');            
            return Datatables::of($anagrafiche)      

            ->edit_column('updated_at', '{{ formato($updated_at) }}') 
            ->add_column('actions', '<a href="{{{ URL::to(\'anagrafiche/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >Visualizza</a>
                ')
            ->remove_column('id')
            ->make();
        }

    }	

}