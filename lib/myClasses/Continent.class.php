<?php
/*
   Represents a single row for the Continent table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Continent extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ContinentCode','ContinentName','GeonameId');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
    
    
   public function load($cid){
       
       $gate = new ContinentTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findByCID($cid);
       
       $this->setContinentCode($result->ContinentCode);
       $this->setContinentName($result->ContinentName);
       $this->setGeonameId($result->GeonameId);
        
   }
   
   public function setContinentCode($ContinentCode){$this->ContinentCode = $ContinentCode;}
   public function setContinentName($ContinentName){$this->ContinentName = $ContinentName;}
   public function setGeonameId($GeonameId){$this->GeonameId = $GeonameId;}

   public function getContinentCode(){return $this->ContinentCode;}
   public function getContinentName(){return $this->ContinentName;}
   public function getGeonameId(){return $this->GeonameId;}
    
    
}

?>