<?php

require_once('app/initialize.php');

$addresses = Address::find_all();

print_r(json_encode($addresses));

$name = strftime('address.json');
header('Content-Disposition: attachment;filename=' . $name);
header('Content-Type: application/json; charset=utf-8');
