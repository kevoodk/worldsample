<?php
/**
 * index.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
    session_start();
    require_once './model/ModelCity.inc.php'; // domainmodel
    require_once './model/ModelCountryLanguage.inc.php'; // domainmodel
    require_once './model/ModelUser.inc.php'; // domainmodel
    require_once './model/ModelCountry.inc.php';
    require_once './view/ViewCountry.inc.php';
    require_once './view/ViewCity.inc.php';
    require_once './view/ViewLanguage.inc.php';
    require_once './view/ViewUser.inc.php';
    require_once './view/ViewLogin.inc.php';
    require_once './controller/Controller.inc.php';

    if (!isset($_GET['f']) || $_GET['f'] === 'A') {
        $model = new User(null, null);
        $con = new Controller($model);
        $view1 = new LoginView($model);
        if (isset($_POST)) {
            $con->auth($_POST);
        }
        print($view1->display());
         
    } elseif (isset($_GET['f']) && $_GET['f'] === 'Z') {   // logout
        $model = new User(null, null);
        $con = new Controller($model);
        $view1 = new LoginView($model);
        $con->logout();
        print($view1->display());
        
    }elseif (isset($_GET['f']) && $_GET['f'] === 'Co') {
        $model = new Country(null, null, null, null, null, null, null, null,  null, null, null, null, null,  null, null );    // init a model
        $con = new Controller($model);                 // init controller
        $view1 = new CountryView($model);                 // init view
        if (isset($_POST)) {
            $con->createCountry($_POST);                  // activate controller
        }
        print($view1->display());

    } elseif (isset($_GET['f']) && $_GET['f'] === 'C') {
        $model = new City('DNK', null, null, null, null);   // init a model
        $con = new Controller($model);                 // init controller
        $view1 = new CityView($model);                 // init view
        if (isset($_POST)) {
            $con->createCity($_POST);                  // activate controller
        }
        print($view1->display());
        
    }  elseif (isset($_GET['f']) && $_GET['f'] === 'L') {
        $model = new CountryLanguage('DNK', null, null, null); // init a model
        $con = new Controller($model);                 // init controller
        $view1 = new LanguageView($model);                     // init a view
        if (isset($_POST)) {
            $con->createLanguage($_POST);                  // activate controller
        }
        print($view1->display());
        
    } elseif (isset($_GET['f']) && $_GET['f'] === 'U') {
        $model = new User(null, null); // init a model
        $con = new Controller($model);              // init controller
        $view1 = new UserView($model);                  // init a view
        if (isset($_POST)) {
            $con->createUser($_POST);               // activate controller
        }
        print($view1->display());
    } 
?>