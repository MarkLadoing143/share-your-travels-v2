<?php
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelPost extends DomainObject
{  
   
   static function getFieldNames() {
      return array('PostID','UID','ParentPost','Title','Message','PostTime','FirstName','LastName','Path');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   public function load($PID){
       
       $gate = new TravelPostTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findByPID($PID);
       
       $this->setPostID($result->PostID);
       $this->setUID ($result->UID);
       $this->setParentPost($result->ParentPost);
       $this->setTitle($result->Title);
       $this->setMessage($result->Message);
       $this->setPostTime($result->PostTime);
       $this->setFirstName($result->FirstName);
       $this->setLastName($result->LastName);
       $this->setPath($result->Path);
       
   }

   public function findForUser($UID){
       
       $gate = new TravelPostTableGateway(DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS)));
       $result = $gate->findForUser($UID);
       return $result;
   }
   
    
    public function setPostID ($PostID){$this->PostID = $PostID;}
    public function setUID ($UID){$this->UID = $UID;}
    public function setParentPost ($ParentPost){$this->ParentPost = $ParentPost;}
    public function setTitle ($Title){$this->Title = $Title;}    
    public function setMessage ($Message){$this->Message = $Message;}
    public function setPostTime ($PostTime){$this->PostTime = $PostTime;}
    public function setFirstName ($FirstName){$this->FirstName = $FirstName;}
    public function setLastName ($LastName){$this->LastName = $LastName;}
    public function setPath($Path){$this->Path = $Path;}
        
    public function getPostID (){return $this->PostID;}
    public function getUID (){return $this->UID;}
    public function getParentPost (){return $this->ParentPost;}
    public function getTitle (){return $this->Title;}  
    public function getMessage (){return $this->Message;}
    public function getPostTime (){return $this->PostTime;}
    public function getFirstName (){return $this->FirstName;}
    public function getLastName (){return $this->LastName;}
    public function getPath (){return $this->Path;}
}

?>