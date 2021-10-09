<?php

// Include required functions and files
require_once('app/initialize.php');

$xml = new SimpleXMLElement('<rootTag/>');

$addresses = Address::find_all();

foreach($addresses as $address):
    export_to_xml($xml, (array) $address);
endforeach;

print_r($xml);

$name = strftime('address.xml');
header('Content-Disposition: attachment;filename=' . $name);
header('Content-Type: text/xml');