<?php
  $q = $_GET["q"]; 
  $xmlDoc = new DOMDocument( );
  $xmlDoc->load( "placeList.xml" );
  $x = $xmlDoc->getElementsByTagName( 'id' );
  for ( $i=0; $i<=$x->length-1; $i++ ) {
    // Process only element nodes.
	$var =  $x->item($i)->nodeType;
    if ( $x->item($i)->nodeType == 1 ) {
		$var1 = $x->item($i)->childNodes->item(0)->nodeValue;
      if ( strcmp($var1, $q) ==0 ) {
		$y = ( $x->item($i)->parentNode );
      }
    }
  }
  $place = ( $y->childNodes );
  echo( "<font size='+1'>" );
 echo ('<div class="panel-group"> <div class="panel panel-default"> <div class="panel-body">');
  for ( $i=0; $i<$place->length; $i++ ) {
    // Process only element nodes.
    if ( $place->item($i)->nodeType == 1 ) {

	  if(strcmp($place->item($i)->nodeName, 'image') ==  0){
			echo("<image src=". $place->item($i)->childNodes->item(0)->nodeValue.">");
			continue;
		}
      echo( "<font color='#3366CC'><b>" . $place->item($i)->nodeName . ":</b></font> " );
      echo( $place->item($i)->childNodes->item(0)->nodeValue );
      echo( "<br />" );
    }
  }
  echo ( "</font>" );
  echo('</div></div></div>');
?>