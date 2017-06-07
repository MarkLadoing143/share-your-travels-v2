<?php
require_once('includes/travel-setup.inc.php');
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class ImageCollection
{  
    
   private $images = array();
    
    
public function loadCollection(){
    
    $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findAllImages();
    
    $this->images= $result;
}

public function loadCollectionByCity($city){
    
    $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findForCity($city);
    
    $this->images= $result;
    
}

public function loadCollectionByCountry($country){
    
    $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findForCountry($country);
    
    $this->images= $result;
    
}

public function loadCollectionByUser($uid){
    
    $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findForUser($uid);
    
    $this->images= $result;
    
}

public function loadCollectionByPost($pid){
    
    $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findForPost($pid);
    
    $this->images= $result;
    
}

public function loadCollectionBySearch($search){
    
    $gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findForSearch($search);
    
    $this->images= $result;
    
}    

public function loadCollectionByCityAndCountry($city, $country) {
	$gate = new TravelImageTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
	$result = $gate->findForCityAndCountry($city, $country);
	
	$this->images= $result;
}
    
public function addImage($images, $key){
    
    if ($key == null) {
        $this->images[] = $obj;
    }
    else {
        if (isset($this->images[$key])) {
            throw new KeyHasUseException("Key $key already in use.");
        }
        else {
            $this->images[$key] = $obj;
        }
    }
}
public function deleteImage($key){
    
    if (isset($this->images[$key])) {
        unset($this->images[$key]);
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getImage($key){
    
    if (isset($this->images[$key])) {
        return $this->images[$key];
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCount(){
    
    return count($this->images);
}



public function getArray(){
    
    return $this->images;
}   
    
}

   
?>