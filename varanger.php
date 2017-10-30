
<?php
$proc=new XsltProcessor;
$proc->importStylesheet(DOMDocument::load("turistveier.xsl")); //load XSL script
echo $proc->transformToXML(DOMDocument::load("turistvegene-data-ut.xml")); //load XML file and echo
?>