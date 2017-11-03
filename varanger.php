
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
foreach ($run->children() as $attraksjon) {
    echo "<strong>Sted: </strong>" . $attraksjon->Sted . "<br>";
    echo "<strong>Informasjon: </strong>" . $attraksjon->Informasjon . "<br>";
    echo "<strong>Varsel: </strong>" . $attraksjon->body . "<br>";
    echo "<br>";
}


?>