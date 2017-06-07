<?php
/*
  Table Data Gateway for the Continent table.
 */
class ContinentTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Continent";
   } 
   protected function getTableName()
   {
      return "GeoContinents";
   }
   protected function getOrderFields() 
   {
      return 'ContinentName';
   }
  
   protected function getPrimaryKeyName() {
      return "ContinentCode";
   }

   private function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT
            ContinentCode,
            ContinentName,
            GeonameId
            FROM geocontinents";
        
      
      return $SQLwithJoins;
   }
    
   
   public function findByCID($cid)
   {      
      $sql = $this->getSQLwithJoins();
      $sql .= " WHERE ContinentCode=:cid";
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':cid' => $cid)) );
   }
    
    
    public function findAllContinents(){
    
      $sql = $this->getSQLwithJoins();
      $sql .= " ORDER BY ContinentName";
      $result = $this->dbAdapter->fetchAsArray($sql, Array());   
      return $this->convertRecordsToObjects($result);
       
   }
}

?>