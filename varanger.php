<!-- Delvis skrevet av Adrian Rovelstad -->

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
