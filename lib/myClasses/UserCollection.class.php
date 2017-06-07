<?php
require_once('includes/travel-setup.inc.php');
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class UserCollection
{  

private $users = array();
    
    
public function loadCollection(){
    
    $gate = new TravelUserTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findAllUsers();
    
    $this->users= $result;
}

public function addUser($users, $key){
    
    if ($key == null) {
        $this->users[] = $obj;
    }
    else {
        if (isset($this->users[$key])) {
            throw new KeyHasUseException("Key $key already in use.");
        }
        else {
            $this->users[$key] = $obj;
        }
    }
}
public function deleteUser($key){
    
    if (isset($this->users[$key])) {
        unset($this->users[$key]);
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getUser($key){
    
    if (isset($this->users[$key])) {
        return $this->users[$key];
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCount(){
    
    return count($this->users);
}



public function getArray(){
    
    return $this->users;
}   
   
    
}

   
?>