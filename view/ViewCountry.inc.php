<?php
/**
 * view/ViewLanguage.inc.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */

require_once 'view/View.inc.php';

class CountryView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }

    private function displayManyCountries() {
        $countries = Country::retrievel($this->model->getName());
        $s = "<div class='haves'>";
        foreach ($countries as $country) {
            $s .=  sprintf("%s: %s<br/>\n"
                , $countries->getName(), $country->getLocalname());
        }
        $s .= "</div>";
        return $s;
    }

    private function countryForm() {
        $s = sprintf("<form action='%s?f=Co' method='post'>\n
                      <div class='gets'>\n
                      <p>
                        Countrycode<br/>
                        <input type='text' name='code' required/>
                      </p>\n
                      <p>
                        Name<br/>
                        <input type='text' name='name' required/>
                      </p>\n
                      <p>
                        continent<br/>
                        <select name='continent' required>
                        <option name='europe'>europe</option>
                        <option name='asia'>asia</option>
                        <option name='north america'>north america</option>
                        <option name='africa'>africa</option>
                        <option name='oceania'>oceania</option>
                        <option name='antarctica'>antarctica</option>
                        <option name='south america'>south america</option>
                        </select>
                      </p>\n
                      <p>
                        region<br/>
                        <input type='text' name='region'/>
                      </p>\n
                      <p>
                        surface Area<br/>
                        <input type='number' name='surfacearea'/>
                      </p>\n
                      <p>
                        Independent Year<br/>
                        <input type='number' name='indepyear'/>
                      </p>\n
                      <p>
                        population<br/>
                        <input type='number' name='population'/>
                      </p>\n
                      <p>
                        Life execpantcy<br/>
                        <input type='number' name='lifeexpectancy'/>
                      </p>\n
                      <p>
                        gnp<br/>
                        <input type='number' name='gnp'/>
                      </p>\n
                      <p>
                        old gnp<br/>
                        <input type='number' name='gnpold'/>
                      </p>\n
                      <p>
                        localname<br/>
                        <input type='text' name='localname'/>
                      </p>\n
                      <p>
                        governmentform<br/>
                        <input type='text' name='governmentform'/>
                      </p>\n
                      <p>
                        head of state<br/>
                        <input type='text' name='headofstate'/>
                      </p>\n
                      <p>
                        capital<br/>
                        <input type='text' name='capital'/>
                      </p>\n
                      <p>
                        country code 2<br/>
                        <input type='text' name='code2'/>
                      </p>\n
                      
                      <p><input type='submit' value='Go!'/></p>
                      </div>\n"
            , $_SERVER['PHP_SELF']
            , $this->model->getName()
        );
        return $s;

    }

    private function displayCountry() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
            , $this->displayManyCountries()
            , $this->countryForm());
        return $s;
    }

    public function display(){
        $this->output($this->displayCountry());
    }
}