

<!-- Skrevet av Adrian Rovelstad og Tom Andreas Vingås -->

<?php
require_once'header.php';
?>

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

?>
<div class="attr__banner">
<h1>VisitVeranger</h1>
</div>


<!-- Ramser opp stedsnavnene i xml arket og linker dem til hver sin side -->
<aside class="attr__nav">
<ul>
    <?php
    foreach ($run->children() as $attraksjon) {
        echo "<li><a href='varanger.php?page=$attraksjon->Sted'> $attraksjon->Sted </a></li>";
    }
    ?>

</ul>
</aside>
<main class="content">
    <div class="left">
        <div class="attr__text">
        <?php
            // Hvis en av linkene er trykket på, så vil informasjonen kun relatert for det stedet vises
            if (isset($_GET['page'])) {
            foreach ($run->children() as $attraksjon) {
                if ($attraksjon->Sted == $_GET['page']) {
                    echo "<h2>" . $attraksjon->Sted . "</h2>";
                    echo"<P>" . $attraksjon->Informasjon . "</p>";
                ?>
        </div>
        <div class="attr__weather">
            <h2>Været</h2>
                <?php
                echo "Dato: " . $attraksjon->Varsel->time->title . " - " . $attraksjon->Varsel->time['from'] .  "<br>" . "Varsel: " .
                        $attraksjon->Varsel->time->body . "<br>";

            ?>
        </div>
    </div>
    <div class="right">
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
        // Marker for stedet det gjelder

                var marker = L.marker([<?php echo $attraksjon->Latitude; ?>, <?php echo $attraksjon->Longitude; ?>]).addTo(mymap);
                marker.bindPopup(<?php echo $attraksjon->Sted;?>);
        </script>
        <?php
            }
        }
        }
        ?>
    </div>
</main>


<?php
require_once'footer.php';
?>
