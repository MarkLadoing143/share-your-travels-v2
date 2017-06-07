<?php
/*
   Represents a single row for the City table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class City extends DomainObject
{  
   
   static function getFieldNames() {
      return array('GeoNameID','AsciiName','CountryCodeISO','Latitude','Longitude','Population','Elevation','CityCode');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
    
   public function load($gid){
       
       $gate = new CityTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findByGeoID($gid);
       
       $this->setGeoNameID($result->GeoNameID);
       $this->setAsciiName($result->AsciiName);
       $this->setCountryCodeISO($result->CountryCodeISO);
       $this->setLatitude($result->Latitude);
       $this->setLongitude($result->Longitude);
       $this->setPopulation($result->Population);
       $this->setElevation($result->Elevation);
       $this->setCityCode($result->CityCode);
       
   }
   
   public function loadCityName($id){
       
       $gate = new CityTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findByImageID($id);
       
       $this->setAsciiName($result);
      
   }
   
   public function setGeoNameID($GeoNameID){$this->GeoNameID = $GeoNameID;}
   public function setAsciiName($AsciiName){$this->AsciiName = $AsciiName;}
   public function setCountryCodeISO($CountryCodeISO){$this->CountryCodeISO = $CountryCodeISO;}
   public function setLatitude($Latitude){$this->Latitude = $Latitude;}
   public function setLongitude($Longitude){$this->Longitude = $Longitude;}
   public function setPopulation($Population){$this->Population = $Population;}
   public function setElevation($Elevation){$this->Elevation = $Elevation;}
   public function setCityCode($CityCode){$this->CityCode = $CityCode;}
    
   public function getGeoNameID(){return $this->GeoNameID;}
   public function getAsciiName(){return $this->AsciiName;}
   public function getCountryCodeISO(){return $this->CountryCodeISO;}
   public function getLatitude(){return $this->Latitude;}
   public function getLongitude(){return $this->Longitude;}
   public function getPopulation(){return $this->Population;}
   public function getElevation(){return $this->Elevation;}
   public function getCityCode(){return $this->CityCode;}
}

?>