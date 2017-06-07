<?php
require_once('includes/travel-setup.inc.php');

class PostCollection
{  
   
    private $posts = array();
    
    
public function loadCollection(){
    
    $gate = new TravelPostTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findAllPosts();
    
    $this->posts = $result;
}
    
public function loadCollectionByUser($uid){
    
    $gate = new TravelPostTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
    $result = $gate->findAllPostsByUser($uid);
    
    $this->posts = $result;
}

public function addPost($post, $key){
    
    if ($key == null) {
        $this->posts[] = $obj;
    }
    else {
        if (isset($this->posts[$key])) {
            throw new KeyHasUseException("Key $key already in use.");
        }
        else {
            $this->posts[$key] = $obj;
        }
    }
}
public function deletePost($key){
    
    if (isset($this->posts[$key])) {
        unset($this->posts[$key]);
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getPost($key){
    
    if (isset($this->posts[$key])) {
        return $this->posts[$key];
    }
    else {
        throw new KeyInvalidException("Invalid key $key.");
    }
    
}

public function getCount(){
    
    return count($this->posts);
}



public function getArray(){
    
    return $this->posts;
}
}
?>