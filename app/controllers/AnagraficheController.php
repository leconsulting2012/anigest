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

        // Show the page
        return View::make('anagrafiche/create_edit', compact('title', 'mode'));
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
            'cognome'   => 'required|min:2|max:50|alpha_dash',
            'nome'   => 'min:2|max:50|alpha_dash',
            'indirizzo1'   => 'min:2|max:50',
            'indirizzo2'   => 'min:2|max:50',
            'cap'   => 'min:5|max:8',
            'citta'   => 'min:2|max:50',
            'provincia'   => 'min:2|max:50',
            'telefono'   	=> 'min:2|max:50|alpha_dash',
            'fax'   		=> 'min:2|max:50|alpha_dash',
            'cellulare'   => 'min:2|max:50|alpha_dash',
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
            $this->anagrafica->cognome 				= Input::get('cognome');
            $this->anagrafica->nome 				= Input::get('nome');
            $this->anagrafica->indirizzo1  			= Input::get('indirizzo1');
            $this->anagrafica->indirizzo2  			= Input::get('indirizzo2');
            $this->anagrafica->cap       			= Input::get('cap');
            $this->anagrafica->citta 				= Input::get('citta');
            $this->anagrafica->provincia    		= Input::get('provincia');
            $this->anagrafica->telefono    			= Input::get('telefono');
            $this->anagrafica->fax    				= Input::get('fax');
            $this->anagrafica->cellulare    		= Input::get('cellulare');
            $this->anagrafica->cfiscale    			= Input::get('cfiscale');
            $this->anagrafica->piva    				= Input::get('piva');                                    
            $this->anagrafica->email    			= Input::get('email'); 

            //$this->antenna->user_id          = $user->id;

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
            'cognome'   => 'required|min:2|max:50|alpha_dash',
            'nome'   => 'min:2|max:50|alpha_dash',
            'indirizzo1'   => 'min:2|max:50',
            'indirizzo2'   => 'min:2|max:50',
            'cap'   => 'min:5|max:8',
            'citta'   => 'min:2|max:50',
            'provincia'   => 'min:2|max:50',
            'telefono'      => 'min:2|max:50|alpha_dash',
            'fax'           => 'min:2|max:50|alpha_dash',
            'cellulare'   => 'min:2|max:50|alpha_dash',
            'cfiscale'   => 'min:16|max:16|alpha_dash',
            'piva'   => 'numeric',
            'email'   => 'email'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {
            $oldanagrafica = clone $anagrafica;
            $this->anagrafica->cognome              = Input::get('cognome');
            $this->anagrafica->nome                 = Input::get('nome');
            $this->anagrafica->indirizzo1           = Input::get('indirizzo1');
            $this->anagrafica->indirizzo2           = Input::get('indirizzo2');
            $this->anagrafica->cap                  = Input::get('cap');
            $this->anagrafica->citta                = Input::get('citta');
            $this->anagrafica->provincia            = Input::get('provincia');
            $this->anagrafica->telefono             = Input::get('telefono');
            $this->anagrafica->fax                  = Input::get('fax');
            $this->anagrafica->cellulare            = Input::get('cellulare');
            $this->anagrafica->cfiscale             = Input::get('cfiscale');
            $this->anagrafica->piva                 = Input::get('piva');                                    
            $this->anagrafica->email                = Input::get('email'); 
            $this->anagrafica->azienda_id           = Auth::user()->azienda_id;

            $anagrafica->save();


        } else {
            return Redirect::to('anagrafiche/' . $anagrafica->id . '/edit')->with('error', Lang::get('users/anagrafiche/messages.edit.error'));
        }

        if(empty($error)) {
            // Redirect to the new user page
            return Redirect::to('anagrafiche/' . $anagrafica->id . '/edit')->with('success', Lang::get('users/anagrafiche/messages.edit.success'));
        } else {
            return Redirect::to('anagrafiche/' . $anagrafica->id . '/edit')->with('error', Lang::get('users/anagrafiche/messages.edit.error'));
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

        // Show the page
        return View::make('anagrafiche/create_edit', compact('anagrafica', 'title', 'mode'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getData()
    {

        $anagrafiche = Anagrafica::select(array('anagrafiche.id', 'anagrafiche.cognome', 'anagrafiche.nome', 'anagrafiche.indirizzo1', 'anagrafiche.updated_at'))
        ->where('anagrafiche.azienda_id', '=', Auth::user()->azienda_id);
                          //  ->join('modelliAntenna','modelliAntenna.id','=', 'anagrafiche.modelloAntenna_id');
        return Datatables::of($anagrafiche)

        //->edit_column('updated_at', Carbon::createFromFormat('Y/m/d H:i:s', time()))

        ->add_column('actions', '<a href="{{{ URL::to(\'anagrafiche/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'anagrafiche/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }	

}