<?php

$m = new MongoClient();
$db = $m->traveller;
$collection = $db->npcs;

echo "<html><body>";

$cursor = $collection->find();
foreach ($cursor as $doc) {
    $line1 = '<p>';
    $line1 .= $doc['Name'] . " ";
    $line1 .= $doc['Rank'] . " ";
    $line1 .= $doc['UPP'] . " ";
    $line1 .= "\n";
    echo $line1;
}

 
echo "</body></html>";

