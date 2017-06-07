<?php
require_once('includes/travel-setup.inc.php');
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class CityCollection
{  
    
   private $cities = array();
    
    
public function loadCollection(){
    
    $gate = new CityTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findCitiesWithImages();
    
    $this->cities= $result;
    
}

public function addCity($cities, $key){
    
    if ($key == null) {
        $this->cities[] = $obj;
    }
    else {
        if (isset($this->cities[$key])) {
            throw new KeyHasUseException("Key $key already in use.");
        }
        else {
            $this->cities[$key] = $obj;
        }
    }
}
public function deleteCity($key){
    
    if (isset($this->cities[$key])) {
        unset($this->cities[$key]);
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCity($key){
    
    if (isset($this->cities[$key])) {
        return $this->cities[$key];
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCount(){
    
    return count($this->cities);
}



public function getArray(){
    
    return $this->cities;
}   
   
    
}

   
?>