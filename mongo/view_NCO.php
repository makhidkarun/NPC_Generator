<?php

$m = new MongoClient();
$db = $m->traveller;
$collection = $db->npcs;

$cursor = $collection->find(array('Rank'=>'1SG'));
foreach ($cursor as $doc) {
    $line1 = '';
    $line1 .= $doc['Name'] . " ";
    $line1 .= $doc['Rank'] . " ";
    $line1 .= $doc['UPP'] . " ";
    $line1 .= "\n";
    echo $line1;
}

 

