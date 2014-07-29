<?php

class WizardsController extends AdminController {

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;
    protected $antenna;
    protected $user;
    protected $modelloAntenna;
    protected $installatore;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Antenna $antenna, User $user, ModelloAntenna $modelloAntenna)
    {
        parent::__construct();
        $this->antenna = $antenna;
        $this->user = $user;
        $this->modelloAntenna = $modelloAntenna;

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

        // Grabbo tutte le antenne dell'azienda
        $modelliAntenna = $this->modelloAntenna->all(); 

        // Show the page
        //return View::make('routers/index', compact('routers', 'title'));
        return View::make('admin/wizards/aria', compact('title', 'modelliAntenna'));
	}


}
