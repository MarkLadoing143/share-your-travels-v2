<?php
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelImage extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ImageID','UID','Path','ImageContent','Title','Description','Latitude','Longitude','CityCode','CountryCodeISO');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
    
   public function load($id){
       
       $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findById($id);
       
       $this->setImageID($result->ImageID);
       $this->setUID($result->UID);
       $this->setPath($result->Path);
       $this->setImageContent($result->ImageContent);
       $this->setTitle($result->Title);
       $this->setDescription($result->Description);
       $this->setLatitude($result->Latitude);
       $this->setLongitude($result->Longitude);
       $this->setCityCode($result->CityCode);
       $this->setCountryCodeISO($result->CountryCodeISO);
       
   }
   
   public function setImageID($ImageID){$this->ImageID = $ImageID;}
   public function setUID($UID){$this->UID = $UID;}
   public function setPath($Path){$this->Path = $Path;}
   public function setImageContent($ImageContent){$this->ImageContent = $ImageContent;}
   public function setTitle($Title){$this->Title = $Title;}
   public function setDescription($Description){$this->Description = $Description;}
   public function setLatitude($Latitude){$this->Latitude = $Latitude;}
   public function setLongitude($Longitude){$this->Longitude = $Longitude;}
   public function setCityCode($CityCode){$this->CityCode = $CityCode;}
   public function setCountryCodeISO($CountryCodeISO){$this->CountryCodeISO = $CountryCodeISO;}
    
    
   public function getImageID(){return $this->ImageID;}
   public function getUID(){return $this->UID;}
   public function getPath(){return $this->Path;}
   public function getImageContent(){return $this->ImageContent;}
   public function getTitle(){return $this->Title;}
   public function getDescription(){return $this->Description;}
   public function getLatitude(){return $this->Latitude;}
   public function getLongitude(){return $this->Longitude;}
   public function getCityCode(){return $this->CityCode;}
   public function getCountryCodeISO(){return $this->CountryCodeISO;}
}

?>