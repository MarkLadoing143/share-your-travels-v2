<?php
/*
  Table Data Gateway for the City table.
 */
class CityTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "City";
   } 
   protected function getTableName()
   {
      return "GeoCities";
   }
   protected function getOrderFields() 
   {
      return 'AsciiName';
   }
   protected function getPrimaryKeyName() {
      return "GeoNameID";
   }
   
   public function findCitiesWithImages()
   {
      $sql = "SELECT GeoNameID, AsciiName, GeoCities.CountryCodeISO as CountryCodeISO, GeoCities.Latitude as Latitude, GeoCities.Longitude as Longitude, Population, Elevation, TravelImageDetails.CityCode as CityCode FROM GeoCities INNER JOIN TravelImageDetails ON GeoCities.GeoNameID = TravelImageDetails.CityCode GROUP BY GeoCities.GeoNameID, GeoCities.AsciiName ORDER BY AsciiName  ";  
      
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }

   public function getSQLwithJoins()
   {
      $SQLwithJoins =  "SELECT GeoNameID, AsciiName, GeoCities.CountryCodeISO as CountryCodeISO, GeoCities.Latitude as Latitude, GeoCities.Longitude as Longitude, Population, Elevation, TravelImageDetails.CityCode as CityCode FROM GeoCities INNER JOIN TravelImageDetails ON GeoCities.GeoNameID = TravelImageDetails.CityCode AND travelimagedetails.CityCode IS NOT NULL";  
      
      return $SQLwithJoins;
   }
    
    
   public function findByGeoID($gid){
       
      $sql = $this->getSQLwithJoins() . ' WHERE geocities.GeoNameID=:gid';
      $sql .= " GROUP BY GeoCities.GeoNameID, GeoCities.AsciiName ORDER BY AsciiName"; 
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':gid' => $gid)) );
   }
    
    
   public function findByImageID($id){
       
       $sql = "SELECT geocities.AsciiName
              FROM travelimagedetails
              INNER JOIN geocities
              ON travelimagedetails.CityCode = geocities.GeoNameID
              AND travelimagedetails.CityCode IS NOT NULL" . ' WHERE TravelImageDetails.ImageID=:id';
       $sql .= " GROUP BY travelimagedetails.ImageID";
       return $this->dbAdapter->fetchField($sql, Array(':id' => $id));
   }
}

?>