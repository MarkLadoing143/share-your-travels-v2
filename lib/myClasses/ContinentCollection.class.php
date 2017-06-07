<?php
require_once('includes/travel-setup.inc.php');
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class ContinentCollection
{  
    
    private $contients = array();
    
    
public function loadCollection(){
    
    $gate = new ContinentTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findAllContinents();
    
    $this->contients= $result;
    
}

public function addContinent($contients, $key){
    
    if ($key == null) {
        $this->contients[] = $obj;
    }
    else {
        if (isset($this->contients[$key])) {
            throw new KeyHasUseException("Key $key already in use.");
        }
        else {
            $this->contients[$key] = $obj;
        }
    }
}
public function deleteContinent($key){
    
    if (isset($this->contients[$key])) {
        unset($this->contients[$key]);
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getContinent($key){
    
    if (isset($this->contients[$key])) {
        return $this->contients[$key];
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCount(){
    
    return count($this->contients);
}



public function getArray(){
    
    return $this->contients;
}   
   
    
}

   
?>