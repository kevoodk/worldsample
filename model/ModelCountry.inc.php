<?php
/**
 * model/ModelCountry.inc.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once 'model/DbP.inc.php';
require_once 'model/DbH.inc.php';
require_once 'model/ModelIf.inc.php';
require_once 'model/ModelA.inc.php';

class Country extends Model implements ModelIf {
    private $code;
    private $name;
    private $continent;
    private $region;
    private $surfacearea;
    private $indepyear;
    private $population;
    private $lifeexpectancy;
    private $gnp;
    private $gnpold;
    private $localname;
    private $governmentform;
    private $headofstate;
    private $capital;
    private $code2;
 // problem with too many arguments
    public function __construct($code) {
        $this->code = $code;


    }

    public function getCode() {
        return $this->code;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getContinent() {
        return $this->continent;
    }
    public function setContinent($continent){
        $this->continent = $continent;
    }

    public function getRegion() {
        return $this->region;
    }
    public function setRegion($region){
        $this->region = $region;
    }

    public function getSurfacearea() {
        return $this->surfacearea;
    }
    public function setSurfacearea($surfacearea){
        $this->surfacearea = $surfacearea;
    }

    public function getIndepyear() {
        return $this->indepyear;
    }
    public function setIndepyear($indepyear){
        $this->indepyear = $indepyear;
    }

    public function getPopulation() {
        return $this->population;
    }
    public function setPopulation($population){
        $this->population = $population;
    }

    public function getLifeexpectancy() {
        return $this->lifeexpectancy;
    }
    public function setLifeexoectancy($lifeexpectancy){
        $this->lifeexpectancy = $lifeexpectancy;
    }

    public function getGnp() {
        return $this->gnp;
    }
    public function setGnp($gnp){
        $this->gnp = $gnp;
    }

    public function getGnpold() {
        return $this->gnpold;
    }
    public function setGnpold($gnpold){
        $this->gnpold = $gnpold;
    }

    public function getLocalname() {
        return $this->localname;
    }
    public function setLocalname($localname){
        $this->localname = $localname;
    }

    public function getGovernmentform(){
        return $this->governmentform;
    }
    public function setGovernmentform($governmentform){
        $this->governmentform = $governmentform;
    }

    public function getHeadofstate() {
        return $this->headofstate;
    }
    public function setHeadofstate($headofstate){
        $this->headofstate = $headofstate;
    }

    public function getCapital() {
        return $this->capital;
    }
    public function setCapital($capital){
        $this->capital = $capital;
    }

    public function getCode2() {
        return $this->code2;
    }
    public function setCode2($code2){
        $this->code2 = $code2;
    }


    public function create() {
        $sql = sprintf("insert into country ( code
                                                    , name
                                                    , continent
                                                    , region
                                                    , surfacearea
                                                    , indepyear
                                                    , population
                                                    , lifeexpectancy
                                                    , gnp
                                                    , gnpold
                                                    , localname
                                                    , governmentform
                                                    , headofstate
                                                    , capital
                                                    , code2)
                        values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $this->getCode()
            , $this->getName()
            , $this->getContinent()
            , $this->getRegion()
            , $this->getSurfacearea()
            , $this->getIndepyear()
            , $this->getPopulation()
            , $this->getLifeexpectancy()
            , $this->getGnp()
            , $this->getGnpold()
            , $this->getLocalname()
            , $this->getGovernmentform()
            , $this->getHeadofstate()
            , $this->getCapital()
            , $this->getCode2());

        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
        } catch(PDOException $e) {
            printf("<p>Insert failed: <br/>%s</p>\n",
                $e->getMessage());
        }
        $dbh->query('commit');
    }
    public function update() {}
    public function delete() {}

    public static function retrievel($name){
        $countries = array();
        $dbh = Model::connect();
        $sql = "select *";
        $sql .= " from country";
        $sql .= " where name = :name";
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':name', $name);
            $q->execute();
            while ($row = $q->fetch()) {
                $countries = self::createObject($row);
                array_push($countries, $name);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $countries;
        }
    }
    public static function retrievem() {
        $countries = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from country";
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
            while ($row = $q->fetch()) {
                $country = self::createObject($row);
                array_push($countries, $country);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $countries;
        }
    }
    public static function createObject($a) {
        $country = new Country($a['code']);
        $country->setName($a['name']);
        $country->setContinent($a['continent']);
        $country->setRegion($a['region']);
        $country->setSurfacearea($a['surfacearea']);
        $country->setIndepyear($a['indepyear']);
        $country->setPopulation($a['population']);
        $country->setLifeexoectancy($a['lifeexpectancy']);
        $country->setGnp($a['gnp']);
        $country->setGnpold($a['gnpold']);
        $country->setLocalname($a['localname']);
        $country->setGovernmentform($a['governmentform']);
        $country->setHeadofstate($a['headofstate']);
        $country->setCapital($a['capital']);
        $country->setCode2($a['code2']);
        return $country;
    }

}