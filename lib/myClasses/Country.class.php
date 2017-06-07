<?php
/*
   Represents a single row for the Country table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Country extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ISO','fipsCountryCode','ISO3','ISONumeric','CountryName','Capital','GeoNameID','Area','Population','Continent','TopLevelDomain','CurrencyCode','CurrencyName','PhoneCountryCode','Languages','PostalCodeFormat','PostalCodeRegex','Neighbours','CountryDescription');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
    
    public function load($country){
        
       $gate = new CountryTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findById($country);
        
       $this->setISO($result->ISO);
       $this->setfipsCountryCode($result->fipsCountryCode);
       $this->setISO3($result->ISO3);
       $this->setISONumeric($result->ISONumeric);
       $this->setCountryName($result->CountryName);
       $this->setCapital($result->Capital);
       $this->setGeoNameID($result->GeoNameID);
       $this->setArea($result->Area);
       $this->setPopulation($result->Population);
       $this->setContinent($result->Continent);
       $this->setTopLevelDomain($result->TopLevelDomain);
       $this->setCurrencyCode($result->CurrencyCode);
       $this->setCurrencyName($result->CurrencyName);
       $this->setPhoneCountryCode($result->PhoneCountryCode);
       $this->setLanguages($result->Languages);
       $this->setPostalCodeFormat($result->PostalCodeFormat);
       $this->setPostalCodeRegex($result->PostalCodeRegex);
       $this->setNeighbours($result->Neighbours);
       $this->setCountryDescription($result->CountryDescription);
    
    }
    
   
    public function setISO($ISO){$this->ISO = $ISO;}
    public function setfipsCountryCode($fipsCountryCode){$this->fipsCountryCode = $fipsCountryCode;}
    public function setISO3($ISO3){$this->ISO3 = $ISO3;}
    public function setISONumeric($ISONumeric){$this->ISONumeric = $ISONumeric;}
    public function setCountryName($CountryName){$this->CountryName = $CountryName;}
    public function setCapital($Capital){$this->Capital = $Capital;}
    public function setGeoNameID($GeoNameID){$this->GeoNameID = $GeoNameID;}
    public function setArea($Area){$this->Area = $Area;}
    public function setPopulation($Population){$this->Population = $Population;}
    public function setContinent($Continent){$this->Continent = $Continent;}
    public function setTopLevelDomain($TopLevelDomain){$this->TopLevelDomain = $TopLevelDomain;}
    public function setCurrencyCode($CurrencyCode){$this->CurrencyCode = $CurrencyCode;}
    public function setCurrencyName($CurrencyName){$this->CurrencyName = $CurrencyName;}
    public function setPhoneCountryCode($PhoneCountryCode){$this->PhoneCountryCode = $PhoneCountryCode;}
    public function setLanguages($Languages){$this->Languages = $Languages;}
    public function setPostalCodeFormat($PostalCodeFormat){$this->PostalCodeFormat = $PostalCodeFormat;}
    public function setPostalCodeRegex($PostalCodeRegex){$this->PostalCodeRegex = $PostalCodeRegex;}
    public function setNeighbours($Neighbours){$this->Neighbours = $Neighbours;}
    public function setCountryDescription($CountryDescription){$this->CountryDescription = $CountryDescription;}
    
    
    public function getISO(){return $this->ISO;}
    public function getfipsCountryCode(){return $this->fipsCountryCode;}
    public function getISO3(){return $this->ISO3 = $ISO3;}
    public function getISONumeric(){return $this->ISONumeric;}
    public function getCountryName(){return $this->CountryName;}
    public function getCapital(){return $this->Capital;}
    public function getGeoNameID(){return $this->GeoNameID;}
    public function getArea(){return $this->Area;}
    public function getPopulation(){return $this->Population;}
    public function getContinent(){return $this->Continent;}
    public function getTopLevelDomain(){return $this->TopLevelDomain;}
    public function getCurrencyCode(){return $this->CurrencyCode;}
    public function getCurrencyName(){return $this->CurrencyName;}
    public function getPhoneCountryCode(){return $this->PhoneCountryCode;}
    public function getLanguages(){return $this->Languages;}
    public function getPostalCodeFormat(){return $this->PostalCodeFormat;}
    public function getPostalCodeRegex(){return $this->PostalCodeRegex;}
    public function getNeighbours(){return $this->Neighbours;}
    public function getCountryDescription(){return $this->CountryDescription;}
}

?>