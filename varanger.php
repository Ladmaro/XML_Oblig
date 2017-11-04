<!-- Delvis skrevet av Adrian Rovelstad -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
      integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
      crossorigin=""/>
<style>
    #mapContainer{
        position: absolute;
        top:0;
        right:0;
        bottom:100px;
        left:0;
        height:400px;
        width:700px;
    }
</style>
<?php

// Load the XML source
$xml = new DOMDocument;
$xml->load('turistvegene_data_ut.xml');

$xsl = new DOMDocument;
$xsl->load('turistveier_collect.xsl');

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules

$newxml = $proc->transformToXML($xml);

$run = simplexml_load_string($newxml);
if (isset($_GET['page'])) {
foreach ($run->children() as $attraksjon) {
    if ($attraksjon->Sted == $_GET['page']) {
        echo "Sted: " . $attraksjon->Sted . "<br>" . "Informasjon: " . $attraksjon->Informasjon
            . "<br>" . "Varsel: " . $attraksjon->Varsel->body . "<br>";

?>

<div id="mapContainer"></div>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
    integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
    crossorigin=""></script>
    <script>
        //Setter standardvisning av kartet, 12 i mymap kan endres på. Den bestemmer standardzoom når du åpner siden.
        var mymap = L.map('mapContainer').setView([70.298378, 29.915771], 8);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
maxZoom: 18,
id: 'mapbox.streets',
accessToken: 'pk.eyJ1IjoibXVyYXJuIiwiYSI6ImNqOWpwdDhveTNyeXUyeHF5dW9pdjY4bTkifQ.QQMjgOHn9Bnn7TITz_2GRw'
}).addTo(mymap);
// Legger til marker på kartet og legger til en beskrivelse.
// Marker for Nesseby

        var marker = L.marker([<?php $attraksjon->Latitude ?>, <?php $attraksjon->Longitude ?>]).addTo(mymap);
        marker.bindPopup(<?php echo $attraksjon->Sted?>);
</script>
<?php
    }
}
}
?>




<ul>
    <?php
    foreach ($run->children() as $attraksjon) {
        echo "<li><a href='varanger.php?page=$attraksjon->Sted'> $attraksjon->Sted </a></li>";
    }
    ?>

</ul>