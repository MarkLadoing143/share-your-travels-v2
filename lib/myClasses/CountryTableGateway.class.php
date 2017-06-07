<?php
/*
  Table Data Gateway for the Country table.
 */
class CountryTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Country";
   } 
   protected function getTableName()
   {
      return "GeoCountries";
   }
   protected function getOrderFields() 
   {
      return 'ISO';
   }
  
   protected function getPrimaryKeyName() {
      return "ISO";
   }

      public function findCountriesWithImages()
   {
      $sql = $this->getSQLwithJoins();
      $sql .= " GROUP BY geocountries.ISO";
      $sql .= " ORDER BY geocountries.CountryName";
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }
    
    public function findCountriesWithImagesByCountry($country){

      $sql = $this->findCountriesWithImages() . ' WHERE ISO=:country';
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':country' => $country)) );       
}

     public function getSQLwithJoins()
   {
      $SQLwithJoins =  "SELECT ISO, fipsCountryCode, ISO3, ISONumeric, CountryName, Capital, GeoNameID, Area,Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, PostalCodeFormat, PostalCodeRegex, Neighbours, CountryDescription
FROM GeoCountries INNER JOIN TravelImageDetails ON GeoCountries.ISO = TravelImageDetails.CountryCodeISO";  
      
      return $SQLwithJoins;
   }


public function findById($country)
   {
      $sql = $this->getSQLwithJoins() . ' WHERE geocountries.ISO=:country';
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':country' => $country)) );
   }

    

}
?>