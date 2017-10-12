<?php
/**
 * model/ModelCity.inc.php
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once 'model/ModelA.inc.php';
require_once 'model/ModelCountry.inc.php';

class City extends Model {
    private $name;
    private $country;
    private $id;
    private $population;
    private $district;

    public function __construct($countrycode
        , $district
        , $id
        , $name
        , $population) {
        $this->country = new Country($countrycode);
        $this->name = $name;
        $this->district = $district;
        $this->id = $id;
        $this->population = $population;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getName() {
        return $this->name;
    }

    public function getDistrict() {
        return $this->district;
    }

    public function getId() {
        return $this->id;
    }

    public function getPopulation() {
        return $this->population;
    }

    public function create() {
        $sql = sprintf("insert into city (name, countrycode, district, population) 
                        values ('%s', '%s', '%s', %s)"
            , $this->getName()
            , $this->getCountry()->getCode()
            , $this->getDistrict()
            , $this->getPopulation());

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

    public function update() {}     // required by ModelA 
    public function delete() {}     // required by ModelA

    public static function retrieve1($name) {
        $cities = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from city";
        $sql .= " where name = :name";
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':name', $name);
            $q->execute();
            while ($row = $q->fetch()) {
                $city = self::createObject($row);
                array_push($cities, $city);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $cities;
        }
    }

    public static function retrievem() {
        $cities = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from city";
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
            while ($row = $q->fetch()) {
                $city = self::createObject($row);
                array_push($cities, $city);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $cities;
        }
    }

    public static function retrievec($countrycode) {
        $cities = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from city";
        $sql .= " where countrycode = :cc";
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':cc', $countrycode);
            $q->execute();
            while ($row = $q->fetch()) {
                $city = self::createObject($row);
                array_push($cities, $city);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $cities;
        }
    }

    public static function createObject($a) {
        $id = $a['id'];
        $name = $a['name'];
        $district = $a['district'];
        $population = $a['population'];
        $countrycode = $a['countrycode'];
        $city = new City($countrycode
            , $district
            , $id
            , $name
            , $population);
        return $city;
    }
}