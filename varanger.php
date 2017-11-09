<!-- Kontrollert av Adrian Rovelstad og Tom Andreas Krane Vingås-->
<?php
require_once('templates/header.php');
?> 
<?php

// Load the XML source
$xml = new DOMDocument;
$xml->load('xml/turistvegene_data_ut.xml');

$xsl = new DOMDocument;
$xsl->load('xml/turistveier_collect.xsl');

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules

$newxml = $proc->transformToXML($xml);

$run = simplexml_load_string($newxml);

?>
<!-- main row-->
<div class="row"> 

    <!--leftt main content-->
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 attr_aside"> 
        <aside class="attr_nav">
            <ul>
                <li><a href="index.php">Til forsiden</a></li>
                <?php
                    foreach ($run->children() as $attraksjon) {
                        echo "<li><a href='varanger.php?page=$attraksjon->Sted'> $attraksjon->Sted </a></li>";
                    }
                ?>
            </ul>
        </aside>
    </div><!--end of left main content-->
    
    <!--right main content-->
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-10">

        <!--first row in main content-->
        <div class="row center-xs center-sm center-md center-lg"> 

            <!--first column-->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 attr__txt">
                <div class="attr_txt1">
                <?php
                    // Hvis en av linkene er trykket på, så vil informasjonen kun relatert for det stedet vises
                    if (isset($_GET['page'])) {
                        foreach ($run->children() as $attraksjon) {
                            if ($attraksjon->Sted == $_GET['page']) {
                                echo "<h2>" . $attraksjon->Sted . "</h2>";
                                echo"<p>" . $attraksjon->Informasjon . "</p>";
                                $siteTitle = $_GET['page']; 
                ?>
                </div>
            </div> <!-- end of first column-->

            <!--secound column-->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 attr__map">
                <div id="mapContainer"></div>
                <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
                integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
                crossorigin="">
                </script>
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
            </div>
        </div><!-- end of first row in main content-->
        
        <!--second row in main content-->
        <div class="row ">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 weather-heading">
                        <h2>Været</h2>
                    </div>
                </div>
                <?php
                $devices = array();
                foreach($attraksjon->Varsel->forecast as $vaer){
                    $device = array();

                    foreach($vaer as $key => $value){
                        $device[(string)$key] = (string)$value;
                    }

                $devices[] = $device;
                } 
                ?>
                <div class="row ">
                <?php
                  foreach ($devices as $varsel) {
                ?>
                
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 weather-box">
                        <?php
                            echo"<h3> " . $varsel['title'] . " </h3>";
                            echo"<p class='dato'>" . $varsel['dato'] . "</p>";
                            echo"<p class='text'>" . $varsel['body'] . "</p><br>";
                        ?>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
        <?php
                }
            }
        }

        ?>
    </div> <!--end of right main content-->
</div><!-- end of main row-->
            <?php
require_once('templates/footer.php');
?>

