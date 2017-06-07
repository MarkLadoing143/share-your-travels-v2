<?php
require_once('includes/travel-setup.inc.php');
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class CountryCollection
{  
    
   private $countries = array();
    
    
public function loadCollection(){
    
    $gate = new CountryTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findCountriesWithImages();
    
    $this->countries= $result;
    
}

public function addCountry($countries, $key){
    
    if ($key == null) {
        $this->countries[] = $obj;
    }
    else {
        if (isset($this->countries[$key])) {
            throw new KeyHasUseException("Key $key already in use.");
        }
        else {
            $this->countries[$key] = $obj;
        }
    }
}
public function deleteCountry($key){
    
    if (isset($this->countries[$key])) {
        unset($this->countries[$key]);
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCountry($key){
    
    if (isset($this->countries[$key])) {
        return $this->countries[$key];
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCount(){
    
    return count($this->countries);
}



public function getArray(){
    
    return $this->countries;
}   
    
}

   
?>