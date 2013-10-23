<?php

try {
    $m = new MongoClient();
    $db = $m->traveller;
    $collection = $db->npcs;
} catch (MongoConnectionException $e) {
    echo "Could not connect to MongoDB: $e" . "\n";
    exit();
}

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

