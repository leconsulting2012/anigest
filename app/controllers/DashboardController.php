<?php

class DashboardController extends AdminController {

    /**
     * Anagrafica Model
     * @var Anagrafica
     */
    protected $anagrafica;

    /**
     * Antenna Model
     * @var Antenna
     */
    protected $antenna;

    /**
     * Azienda Model
     * @var Azienda
     */
    protected $azienda;

    /**
     * Post Model
     * @var Post
     */
    protected $intervento;

    /**
     * User Model
     * @var User
     */
    protected $user;
    protected $router;
    protected $modelloIntervento;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(ModelloIntervento $modelloIntervento, Intervento $intervento, User $user, Azienda $azienda, Antenna $antenna, Router $router, Anagrafica $anagrafica )
    {
        parent::__construct();

        $this->intervento = $intervento;
        $this->user = $user;
        $this->antenna = $antenna;
        $this->azienda = $azienda;
        $this->router = $router;
        $this->anagrafica = $anagrafica;
        $this->modelloIntervento = $modelloIntervento;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
        // Title
        $title = 'Dashboard';

        // Grabbo tutte le interventi dell'azienda
        if ((Auth::user()->hasRole('gestore')) or (Auth::user()->hasRole('admin'))) {
            $interventi = $this->intervento->elencoInterventiDaCompletare('gestore');
        }
        if (Auth::user()->hasRole('installatore')) {
             $interventi = $this->intervento->elencoInterventiDaCompletare();
        }

        $totAnagrafiche = $this->anagrafica->count();
        $totInterventi = $this->intervento->count();

        $totAntenneMagazzino = $this->antenna->contaMagazzino();
        $totRoutersMagazzino = $this->router->contaMagazzino();
        $totInterventiScoperti = $this->intervento->contaInterventiScoperti();
        $totInterventiNonAssegnati = $this->intervento->contaInterventiNonAssegnati();
        // Show the page
        return View::make('dashboard/index', compact('totInterventiNonAssegnati', 'totInterventiScoperti', 'interventi', 'title', 'totAnagrafiche', 'totInterventi', 'totAntenneMagazzino', 'totRoutersMagazzino'));
	}

}