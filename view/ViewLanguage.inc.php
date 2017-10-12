<?php
/**
 * view/ViewLanguage.inc.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */

require_once 'view/View.inc.php';

class LanguageView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }

    private function displayManyLanguages() {
        $languages = CountryLanguage::retrievel($this->model->getCountry()->getCode());
        $s = "<div class='haves'>";
        foreach ($languages as $language) {
            $s .=  sprintf("%s: %s<br/>\n"
                , $language->getLanguage(), $language->getCountry()->getCode());
        }
        $s .= "</div>";
        return $s;
    }

    private function languageForm() {
        $s = sprintf("<form action='%s?f=L' method='post'>\n
                      <div class='gets'>\n
                      <p>
                        Language<br/>
                        <input type='text' name='language' required/>
                      </p>\n
                      <p>
                        IsOfficial<br/>
                        <select name='isofficial' required>
                            <option value='F' selected>No</option>
                            <option value='T'>Yes</option>
                        </select>
                      </p>\n
                      <p>
                        Percentage<br/>
                        <input type='text' name='percentage' required/>
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

    private function displayLanguage() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
            , $this->displayManyLanguages()
            , $this->languageForm());
        return $s;
    }

    public function display(){
        $this->output($this->displayLanguage());
    }
}