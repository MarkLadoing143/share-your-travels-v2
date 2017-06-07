<?php
/*
  Table Data Gateway for the TravelImage table.
 */
class TravelImageTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelImage";
   } 
   protected function getTableName()
   {
      return "TravelImage";
   }
   protected function getOrderFields() 
   {
      return 'ImageID';
   }
  
   protected function getPrimaryKeyName() {
      return "ImageID";
   }

   // must override this
   protected function getSelectStatement()
   {
      return $this->getSQLwithJoins();
   }   
   
   // must override this
   public function findById($id)
   {
      $sql = $this->getSQLwithJoins() . ' WHERE TravelImageDetails.ImageID=:id';
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':id' => $id)) );
   }    
   
   private function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT TravelImageDetails.ImageID as ImageID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, UID, Path FROM TravelImage INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID ";  
      
      return $SQLwithJoins;
   }
   
   public function findForPost($pid)
   {      
      $sql = "SELECT TravelImage.ImageID as ImageID,Title,Description,Latitude, Longitude, CityCode, CountryCodeISO, UID, Path FROM  (TravelImage INNER JOIN TravelPostImages ON TravelImage.ImageID = TravelPostImages.ImageID) INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID";
      
      $sql .= " WHERE PostID=:pid";
      $result = $this->dbAdapter->fetchAsArray($sql, Array(':pid' => $pid));   
      return $this->convertRecordsToObjects($result);   
   }
   
   public function findForUser($uid)
   {      
      $sql = "SELECT TravelImageDetails.ImageID as ImageID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, travelimage.UID, Path FROM TravelImage INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID INNER JOIN traveluserdetails ON travelimage.uid = traveluserdetails.uid";
      $sql .= " WHERE travelimage.UID=:uid";
      $result = $this->dbAdapter->fetchAsArray($sql, Array(':uid' => $uid));   
      return $this->convertRecordsToObjects($result);   
   }
    
   public function findAllImages(){
    
      $sql = $this->getSQLwithJoins();
      $result = $this->dbAdapter->fetchAsArray($sql, Array());   
      return $this->convertRecordsToObjects($result);
       
   }

    public function findForCity($city)
   {  
    
      $sql = $this->getSQLwithJoins();
      $sql .= ' WHERE travelimagedetails.CityCode =:city ';
      $result = $this->dbAdapter->fetchAsArray($sql, Array(':city' => $city));   
      return $this->convertRecordsToObjects($result);   
   }
   
    public function findForCountry($country)
   {  
    
      $sql = $this->getSQLwithJoins();
      $sql .= ' WHERE travelimagedetails.CountryCodeISO =:country';
      $result = $this->dbAdapter->fetchAsArray($sql, Array(':country' => $country));   
      return $this->convertRecordsToObjects($result);   
   }
    
   public function findForSearch($search)
   {  
    
      $sql = $this->getSQLwithJoins();
      $sql .= " WHERE travelimagedetails.Title LIKE '%" . $search . "%'"; 
      $sql .= " OR travelimagedetails.Description LIKE '%" . $search . "%'";
      $result = $this->dbAdapter->fetchAsArray($sql, Array(':search' => $search));   
      return $this->convertRecordsToObjects($result);   
   }
    
	public function findForCityAndCountry($city, $country) {
		$sql = $this->getSQLwithJoins();
		$sql .= ' WHERE travelimagedetails.CountryCodeISO =:country';
		$sql .=	' AND travelimagedetails.CityCode =:city';
		$result = $this->dbAdapter->fetchAsArray($sql, Array(':city' => $city, ':country' => $country));
		return $this->convertRecordsToObjects($result); 
	}
   
}

?>