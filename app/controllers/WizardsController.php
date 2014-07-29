<?php

class WizardsController extends AdminController {

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;



    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct( )
    {
        parent::__construct();

    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function index()
	{
        // Title
        $title = "Procedura Wizard \"Aria C/O Terna Servizi\"";

        // Grabbo tutte le routers dell'azienda
        //$routers = $this->router->elencoRouters($this->user);

        // Show the page
        //return View::make('routers/index', compact('routers', 'title'));
        return View::make('admin/wizards/aria', compact('title'));
	}


}
