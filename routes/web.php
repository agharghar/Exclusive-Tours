<?php





    /*Test route */

        Route::get('/test',function(){
            // Route for test 


        });


    /*Test route */
    Route::get('/', function () {
        return redirect()->route('login');
    });


       
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...


    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/home', 'HomeController@index')->name('home');


    //Auth middleware

    Route::middleware(['auth'])->group(function () {

    /*Register*/
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    /*Register*/


    /*chauffeur*/
    Route::get('chauffeur/new' , 'ChauffeurController@new')->name('chauffeur.new');
    Route::post('chauffeur/add','ChauffeurController@add')->name('chauffeur.add');
    Route::post('chauffeur/repot_add','ChauffeurController@repot_add')->name('chauffeur.repot_add');
    Route::get('chauffeur/repot_new' , 'ChauffeurController@repot_new')->name('chauffeur.repot_new');
    Route::get('chauffeur','ChauffeurController@index')->name('chauffeur.index');
    Route::post('chauffeur/search','ChauffeurController@search')->name('chauffeur.search');
    Route::post('chauffeur/delete','ChauffeurController@delete')->name('chauffeur.delete');
    Route::post('chauffeur/update','ChauffeurController@update')->name('chauffeur.update');
    Route::post('chauffeur/search_date','ChauffeurController@search_date')->name('chauffeur.search_date');
    Route::post('chauffeur/search_repot','chauffeurController@search_repot')->name('chauffeur.search_repot');
    Route::get('chauffeur/getChauffeurs','chauffeurController@getChauffeurs')->name('chauffeur.getChauffeurs');
    Route::get('chauffeur/repot','chauffeurController@repotAll')->name('chauffeur.repotAll');
    Route::post('chauffeur/repot/delete','chauffeurController@repot_delete')->name('chauffeur.repot.delete');
    Route::post('chauffeur/repot/update','chauffeurController@repot_update')->name('chauffeur.repot.update');
    Route::get('chauffeur/repot/{id}','chauffeurController@repotChauffeur')->name('chauffeur.repotChauffeur');
    Route::get('chauffeur/{id}','ChauffeurController@info')->name('chauffeur.info');
    /*chauffeur*/

    /*bus*/
    Route::post('bus/update','busController@update')->name('bus.update');
    Route::get('bus','busController@index')->name('bus.index');
    Route::post('bus/add','busController@add')->name('bus.add');
    Route::get('bus/new' , 'busController@new')->name('bus.new');
    Route::get('/bus/assuranceExpire','busController@assuranceExpire')->name('bus.assuranceExpire');
    Route::post('bus/delete','busController@delete')->name('bus.delete');
    Route::post('bus/search','busController@search')->name('bus.search');
    Route::post('bus/search_date','busController@search_date')->name('bus.search_date');
    Route::get('bus/{id}','busController@info')->name('bus.info');

    /*bus*/

    /*facture*/


            Route::get('facture','Facture@index')->name('facture');

        /*service*/

            Route::get('facture/service','FactureServiceController@info')->name('facture.service');
            Route::get('facture/service/new','FactureServiceController@new')->name('facture.service.new');
            Route::post('facture/service/add','FactureServiceController@add')->name('facture.service.add');
            Route::post('facture/service/delete','FactureServiceController@delete')->name('facture.service.delete');
            Route::get('facture/service/getClients','FactureServiceController@getClients')->name('facture.service.getClients');
            Route::post('facture/service/update','FactureServiceController@update')->name('facture.service.update');
            Route::post('facture/service/search','FactureServiceController@search')->name('facture.service.search');

        /*service*/
      
        /*visite*/ 

            Route::get('facture/visite','FactureVisiteController@info')->name('facture.visite');
            Route::get('facture/visite/new','FactureVisiteController@new')->name('facture.visite.new');
            Route::post('facture/visite/add','FactureVisiteController@add')->name('facture.visite.add');
            Route::post('facture/visite/delete','FactureVisiteController@delete')->name('facture.visite.delete');
            Route::post('facture/visite/update','FactureVisiteController@update')->name('facture.visite.update');
            Route::get('facture/visite/getBuses','FactureVisiteController@getBuses')->name('facture.visite.getBuses');
            Route::post('facture/visite/search','FactureVisiteController@search')->name('facture.visite.search');

        
        /*visite*/ 
      
        /*piece*/            
      
            Route::get('facture/piece','FacturePieceController@info')->name('facture.piece');
            Route::get('facture/piece/new','FacturePieceController@new')->name('facture.piece.new');
            Route::post('facture/piece/add','FacturePieceController@add')->name('facture.piece.add');
            Route::post('facture/piece/delete','FacturePieceController@delete')->name('facture.piece.delete');
            Route::post('facture/piece/update','FacturePieceController@update')->name('facture.piece.update');
            Route::get('facture/piece/getBuses','FacturePieceController@getBuses')->name('facture.piece.getBuses');
            Route::post('facture/piece/search','FacturePieceController@search')->name('facture.piece.search');

      
        /*visite*/ 
       
        /*gazoile*/    
      
            Route::get('facture/gazoile','FactureGazoileController@index')->name('facture.gazoile');
            Route::get('facture/gazoile/new','FactureGazoileController@new')->name('facture.gazoile.new');
            Route::post('facture/gazoile/add','FactureGazoileController@add')->name('facture.gazoile.add');
            Route::post('facture/gazoile/delete','FactureGazoileController@delete')->name('facture.gazoile.delete');
            Route::post('facture/gazoile/bill/delete','FactureGazoileController@bill_delete')->name('facture.gazoile.bill.delete');
            Route::post('facture/gazoile/bill/update','FactureGazoileController@bill_update')->name('facture.gazoile.bill.update');
            Route::post('facture/gazoile/update','FactureGazoileController@update')->name('facture.gazoile.update');
            Route::get('facture/gazoile/getFournisseurs','FactureGazoileController@getFournisseurs')->name('facture.gazoile.getFournisseurs');
            Route::get('facture/gazoile/getNumFacture','FactureGazoileController@getNumFacture')->name('facture.gazoile.getNumFacture');
            Route::post('facture/gazoile/search','FactureGazoileController@search')->name('facture.gazoile.search');
            Route::get('facture/gazoile/{id}','FactureGazoileController@info')->name('facture.gazoile.info');

      
         /*gazoile*/   

    /*facture*/ 

    /*trajet*/
        Route::get('trajet','trajetController@index')->name('trajet.index');
        Route::get('trajet/new','trajetController@new')->name('trajet.new');
        Route::post('trajet/add','trajetController@add')->name('trajet.add');
        Route::post('trajet/delete','trajetController@delete')->name('trajet.delete');
        Route::post('trajet/update','trajetController@update')->name('trajet.update');        
        Route::post('trajet/search','trajetController@search')->name('trajet.search');        
    /*trajet*/

    /*Tour*/
        Route::get('tour','tourController@index')->name('tour.index');
        Route::get('tour/new','tourController@new')->name('tour.new');
        Route::post('tour/add','tourController@add')->name('tour.add');
        Route::post('tour/delete','tourController@delete')->name('tour.delete');
        Route::post('tour/update','tourController@update')->name('tour.update');
        Route::post('tour/search_date','tourController@search_date')->name('tour.search_date');
    /*Tour*/


    /*FOurnisseur*/
        Route::get('fournisseur','fournisseurController@index')->name('fournisseur.index');
        Route::post('fournisseur/delete','fournisseurController@delete')->name('fournisseur.delete');
        Route::post('fournisseur/update','fournisseurController@update')->name('fournisseur.update');
        Route::post('fournisseur/search','fournisseurController@search')->name('fournisseur.search');
        Route::post('fournisseur/add','fournisseurController@add')->name('fournisseur.add');
        Route::get('fournisseur/new','fournisseurController@new')->name('fournisseur.new');
        Route::get('fournisseur/{id}','fournisseurController@info')->name('fournisseur.info');
    /*FOurnisseur*/


    /*Client*/
        Route::get('client','clientController@index')->name('client.index');
        Route::post('client/delete','clientController@delete')->name('client.delete');
        Route::post('client/update','clientController@update')->name('client.update');
        Route::post('client/add','clientController@add')->name('client.add');
        Route::post('client/search','clientController@search')->name('client.search');
        Route::get('client/new','clientController@new')->name('client.new');
        Route::get('client/{id}','clientController@info')->name('client.info');
    /*Client*/



    /*User*/
        Route::get('user','userController@index')->name('user.index');
        Route::get('user/getRoles','userController@getRoles')->name('user.getRoles');
        Route::post('user/delete','userController@delete')->name('user.delete');
        Route::post('user/update','userController@update')->name('user.update');

    
    /*User*/





    });// End Auth Middleware
