<?php
require_once('includes/travel-setup.inc.php');
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelUser extends DomainObject
{  
    
   static function getFieldNames() {
      return array('UID', 'UserName', 'Pass', 'State', 'DateJoined', 'DateLastModified', 'FirstName', 'LastName', 'Address', 'City', 'Region', 'Country', 'Postal', 'Phone', 'Email', 'Privacy');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   public function load($UID)
   {
       $gate = new TravelUserTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findById($UID);
       
       $this->setUID($result->UID);
       $this->setUsername($result->UserName);
       $this->setPass($result->Pass);
       $this->setState($result->State);
       $this->setDateJoined($result->DateJoined);
       $this->setDateLastModified($result->DateLastModified);
       $this->setFirstName($result->FirstName);
       $this->setLastName($result->LastName);
       $this->setAddress($result->Address);
       $this->setCity($result->City);
       $this->setRegion($result->Region);
       $this->setCountry($result->Country);
       $this->setPostal($result->Postal);
       $this->setPhone($result->Phone);
       $this->setEmail($result->Email);
       $this->setPrivacy($result->Privacy);
   }


    public function setUID($UID){$this->UID = $UID;}
    public function setUsername($UserName){$this->Username = $UserName;}
    public function setPass($Pass){$this->Pass = $Pass;}
    public function setState($State){$this->State = $State;}
    public function setDateJoined($DateJoined){$this->DateJoined = $DateJoined;}
    public function setDateLastModified($DateLastModified){$this->DateLastModified = $DateLastModified;}
    public function setFirstName($FirstName){$this->FirstName = $FirstName;}
    public function setLastName($LastName){$this->LastName = $LastName;}
    public function setAddress($Address){$this->Address = $Address;}
    public function setCity($City){$this->City = $City;}
    public function setRegion($Region){$this->Region = $Region;}
    public function setCountry($Country){$this->Country = $Country;}
    public function setPostal($Postal){$this->Postal = $Postal;}
    public function setPhone($Phone){$this->Phone = $Phone;}
    public function setEmail($Email){$this->Email = $Email;}
    public function setPrivacy($Privacy){$this->Privacy = $Privacy;}


    public function getUID(){return $this->UID;}
    public function getUsername(){return $this->Username;}
    public function getPass(){return $this->Pass;}
    public function getState(){return $this->State;}
    public function getDateJoined(){return $this->DateJoined;}
    public function getDateLastModified(){return $this->DateLastModified;}
    public function getFirstName(){return $this->FirstName;}
    public function getLastName(){return $this->LastName;}
    public function getAddress(){return $this->Address;}
    public function getCity(){return $this->City;}
    public function getRegion(){return $this->Region;}
    public function getCountry(){return $this->Country;}
    public function getPostal(){return $this->Postal;}
    public function getPhone(){return $this->Phone;}
    public function getEmail(){return $this->Email;}
    public function getPrivacy(){return $this->Privacy;}
    
}

   
?>