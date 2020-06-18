<?php

require_once('../functions.php');

$userId = $_GET['id'];
$propertyId = $_GET['property'];

$jData = getFileAsJson('../agent/agents.json');

// Update the data
unset($jData->$userId->properties->$propertyId);

saveJsonToFile($jData, '../agent/agents.json');
var_dump ($jData);