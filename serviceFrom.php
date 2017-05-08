<?php
$term = $_GET[ "term" ];
$companies = array(
   array( "label" => "Streibel Hall", "value" => "streibel hall, und, nd" ),
   array( "label" => "Ray Richards", "value" => "ray richards golf course, grand forks, nd" ),
   array( "label" => "The Ralph", "value" => "ralph engelstad arena,nd" ),
   array( "label" => "University Park", "value" => "university park, grand forks, nd" ),
   array( "label" => "Cabela's", "value" => "cabela, east grand forks, mn" ),
   array( "label" => "Crookston", "value" => "crookston, mn" ),
   array( "label" => "Turtle River Park", "value" => "turtle river park, nd" ),
   array( "label" => "GF AFB", "value" => "grand forks AFB, nd" ),
   array( "label" => "UND", "value" => "university of north dakota, nd" ),
   array( "label" => "Alerus Center", "value" => "alerus center, grand forks, nd" ),
   array( "label" => "memorial union, university of north dakota, grand forks, nd", "value" => "memorial union, university of north dakota, grand forks, nd" ),
   array( "label" => "Columbia Mall", "value" => "columbia mall, grand forks, nd" ),
	
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
