<?php

// From http://www.php.net/manual/en/mongo.tutorial.php

$m = new MongoClient();

$db = $m->comedy;

$collection = $db->cartoons;

$document = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson");
$collection->insert($document);

$document = array("title" => "xkcd", "online" => true);
$collection->insert($document);

$cursor = $collection->find();
foreach ($cursor as $document) {
    echo $document['title'] . "\n";
}


