<?php
$term = $_GET[ "term" ];
$companies = array(
   array( "label" => "university", "value" => "university" ),
   array( "label" => "airport", "value" => "airport" ),
   array( "label" => "atm" ,"value" => "atm" ),
   array( "label" => "bakery", "value" => "bakery" ),
   array( "label" => "bank", "value" => "bank" ),
   array( "label" => "bar", "value" => "bar" ),
   array( "label" => "parking", "value" => "parking" ),	
);
$result = array();
foreach ($companies as $company) {
   $companyLabel = $company[ "label" ];
   if ( strpos( strtoupper($companyLabel), strtoupper($term) )!== false ) {
      array_push( $result, $company );
   }
}

echo json_encode( $result );
?>
