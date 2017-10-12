<?php
/**
 * controller/Controller.inc.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once 'model/ModelA.inc.php';

class Controller {
    private $model;
    // are cookies allowed

    public function __construct($model) {
        $this->model = $model;
    }

    public function auth($p) {
        if (isset($p) && count($p) > 0) {
            if (!Authentication::isAuthenticated() 
                    && Model::areCookiesEnabled()
                    && isset($p['uid'])
                    && isset($p['pwd'])) {
                        Authentication::authenticate($p['uid'], $p['pwd']);
            }
            $p = array();
        }
        return;
    }

    public function createCountry($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $country = Country::createObject($p);  // object from array
            $country->create();         // model method to insert into db
            $p = array();
        }
        return;
    }

    public function createCity($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $city = City::createObject($p);  // object from array
            $city->create();         // model method to insert into db
            $p = array();
        }
        return;
    }

    public function createLanguage($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $language = CountryLanguage::createObject($p);  // object from array
            $language->create();         // model method to insert into db
            $p = array();
        }
        return;
    }

    public function createUser($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $user = User::createObject($p);  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
        return;
    }
    
    public function logout() {
        Authentication::Logout();
        return;
    }
}