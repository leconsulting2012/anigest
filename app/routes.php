<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('antenna', 'Antenna');
Route::model('azienda', 'Azienda');
Route::model('modelloAntenna', 'ModelloAntenna');
Route::model('anagrafica', 'Anagrafica');
Route::model('router', 'Router');
Route::model('intervento', 'Intervento');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
Route::pattern('antenna', '[0-9a-z]+');
Route::pattern('modelloAntenna', '[0-9a-z]+');
Route::pattern('anagrafica', '[0-9a-z]+');
Route::pattern('router', '[0-9a-z]+');
Route::pattern('intervento', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});

Route::group(array('before' => 'auth'), function()
{
    # Antenne Management
    Route::get('antenne/{antenna}/show', 'AntenneController@getShow');
    Route::get('antenne/{antenna}/edit', 'AntenneController@getEdit');
    Route::post('antenne/{antenna}/edit', 'AntenneController@postEdit');
    Route::get('antenne/{antenna}/delete', 'AntenneController@getDelete');
    Route::post('antenne/{antenna}/delete', 'AntenneController@postDelete');
    Route::get('antenne/data', 'AntenneController@getData');
    Route::get('antenne/', 'AntenneController@getIndex');
    Route::get('antenne/create', 'AntenneController@getCreate');
    Route::controller('antenne', 'AntenneController');

    # Anagrafiche Management
    Route::get('anagrafiche/{anagrafica}/show', 'AnagraficheController@getShow');
    Route::get('anagrafiche/{anagrafica}/edit', 'AnagraficheController@getEdit');
    Route::post('anagrafiche/{anagrafica}/edit', 'AnagraficheController@postEdit');
    Route::get('anagrafiche/{anagrafica}/delete', 'AnagraficheController@getDelete');
    Route::post('anagrafiche/{anagrafica}/delete', 'AnagraficheController@postDelete');
    Route::get('anagrafiche/data', 'AnagraficheController@getData');
    Route::get('anagrafiche/', 'AnagraficheController@getIndex');
    Route::get('anagrafiche/create', 'AnagraficheController@getCreate');
    Route::controller('anagrafiche', 'AnagraficheController');

    # Interventi Management
    Route::get('interventi/{intervento}/show', 'InterventiController@getShow');
    Route::get('interventi/{intervento}/edit', 'InterventiController@getEdit');
    Route::post('interventi/{intervento}/edit', 'InterventiController@postEdit');
    Route::get('interventi/{intervento}/delete', 'InterventiController@getDelete');
    Route::post('interventi/{intervento}/delete', 'InterventiController@postDelete');
    Route::get('interventi/data', 'InterventiController@getData');
    Route::get('interventi/', 'InterventiController@getIndex');
    Route::get('interventi/create', 'InterventiController@getCreate');
    Route::controller('interventi', 'InterventiController');

    # Routers Management
    Route::get('routers/{router}/show', 'RoutersController@getShow');
    Route::get('routers/{router}/edit', 'RoutersController@getEdit');
    Route::post('routers/{router}/edit', 'RoutersController@postEdit');
    Route::get('routers/{router}/delete', 'RoutersController@getDelete');
    Route::post('routers/{router}/delete', 'RoutersController@postDelete');
    Route::get('routers/data', 'RoutersController@getData');
    Route::get('routers/', 'RoutersController@getIndex');
    Route::get('routers/create', 'RoutersController@getCreate');
    Route::controller('routers', 'RoutersController');

    # Calendari Management
    Route::get('calendario', 'CalendariController@getIndex');
    Route::get('calendario/getEventi', 'CalendariController@getEventi');

    # Magazzini Management
    Route::get('magazzino/antenne', 'AntenneController@getIndexMagazzino');

    # Mappa Management
    Route::get('mappa', 'MappeController@getIndex');

    # Wizards
    Route::get('wizardAria', 'WizardsController@index');
    Route::post('wizardAria', 'WizardsController@salva');

    # Pagina Iniziale
    Route::get('/', 'InterventiController@getIndex');
    Route::get('cercaCitta', 'CittaController@getIndex');    
});

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');

# Index Page - Last route, no matches
//Route::get('/', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));