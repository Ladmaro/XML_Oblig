<!-- skrevet at leonard lisøy -->
<!-- Tar ut data om steder og legger dem i en liste -->
<?php
    $xml = simplexml_load_file("turistvegene_data_ut.xml");
    $menyliste = array();
    foreach($xml->children() as $child) {
        $string = $child->title;
        array_push($menyliste, $string);

    }
    
    
?>



