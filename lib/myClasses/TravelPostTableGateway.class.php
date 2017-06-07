<?php
/*
  Table Data Gateway for the Continent table.
 */
class TravelPostTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
 protected function getDomainObjectClassName()  
   {
      return "TravelPost";
   } 
   protected function getTableName()
   {
      return "TravelPost";
   }
   protected function getOrderFields() 
   {
      return 'PostID';
   }
  
   protected function getPrimaryKeyName() {
      return "PostID";
   }

   // must override this
   protected function getSelectStatement()
   {
      return $this->getSQLwithJoins();
   } 
    
   private function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT
            travelpost.PostID AS PostID,
            travelpost.Title,
            travelpost.Message,
            travelpost.UID,
            travelpost.ParentPost,
            travelpost.PostTime,
            traveluserdetails.FirstName,
            traveluserdetails.LastName,
            travelimage.Path
            FROM travelpost
                INNER JOIN travelpostimages
                ON travelpost.PostID = travelpostimages.PostID
                INNER JOIN travelimage
                ON travelpostimages.ImageID = travelimage.ImageID
                INNER JOIN traveluserdetails
                ON travelpost.UID = traveluserdetails.UID";
      
      return $SQLwithJoins;
   }
    
     public function findForUser($userID)
   {      
      $sql = "SELECT travelpost.PostID AS PostID, UID, ParentPost,Title,Message,PostTime FROM travelpost";
      
      $sql = $this->getSQLwithJoins();
      $sql .= " WHERE UID=?";
      $result = $this->dbAdapter->fetchAsArray($sql, Array($userID));   
      return $this->convertRecordsToObjects($result);   
   } 
    
   public function findByPID($pid)
   {      
      $sql = $this->getSQLwithJoins();
      $sql .= " WHERE travelpost.PostID=:pid";
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':pid' => $pid)) );
   } 
   
   public function findAllPosts(){
    
      $sql = $this->getSQLwithJoins();
      $sql .= " GROUP BY travelpost.PostID";
      $result = $this->dbAdapter->fetchAsArray($sql, Array());   
      return $this->convertRecordsToObjects($result);
       
   }
    
    public function findAllPostsByUser($uid){
    
      $sql = $this->getSQLwithJoins();
      $sql .= " WHERE travelpost.UID=:uid";
      $sql .= " GROUP BY travelpost.PostID";
      $result = $this->dbAdapter->fetchAsArray($sql, Array(':uid' => $uid));   
      return $this->convertRecordsToObjects($result);
       
   }

}

?>