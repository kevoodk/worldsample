<?php
/**
 * view/ViewCity.inc.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */

require_once 'view/View.inc.php';

class CityView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function displayManyCities() {
        $cities = City::retrievec($this->model->getCountry()->getCode());
        $s = "<div class='haves'>";
        foreach ($cities as $city) {
            $s .=  sprintf("%s: %s<br/>\n"
                , $city->getId(), $city->getName());
        }
        $s .= "</div>";
        return $s;
    }

    private function display1c() {
        return sprintf("%s<br/>\n"
            , $this->model->getId());
    }

    private function cityForm() {
        $s = sprintf("<form action='%s?f=C' method='post'>\n
                      <div class='gets'>\n
                      <p>
                        Name<br/>
                        <input type='text' name='name' required/>
                      </p>\n
                      <p>
                        District<br/>
                        <input type='text' name='district' required/>
                      </p>\n
                      <p>
                        Population<br/>
                        <input type='text' name='population' required/>
                      </p>\n
                      <p>
                        Country<br/>
                        <input type='text' name='countrycode'
                        value='%s'
                        required readonly/>
                      </p>\n
                      <p><input type='submit' value='Go!'/></p>
                      </div>\n"
                      , $_SERVER['PHP_SELF']
                      , $this->model->getCountry()->getCode()
                      );
        return $s;
    }

    private function displayCity() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
                    , $this->displayManyCities()
                    , $this->cityForm());
        return $s;
    }
    
    public function display(){
       $this->output($this->displayCity());
    }
}
