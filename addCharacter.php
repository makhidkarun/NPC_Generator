<?php


// require_once 'autoload.php';

try {
    $m = new MongoClient();
    $db = $m->traveller;
    $collection = $db->npcs;
}
catch (MongoConnectionException $e) { 
    echo "Could not connect to MongoDB: $e" . "\n";
    exit();
}
    
$doc = array();

/*
$new_nco = new Trooper(new NCOParams);
$doc['MOS'] = $new_nco->getMos();
$doc['Rank'] = $new_nco->getRank();
$doc['Name'] = $new_nco->getName();
$doc['Age'] =  $new_nco->getAge(); 
$doc['Gender'] = $new_nco->getGender();
$doc['UPP'] = $new_nco->getUpp();

$doc['Skills'] = array();

foreach ($new_nco->getSkills() as $skill => $level) {
    $doc['Skills'][$skill] = $level;
}

$doc['SkillTables'] = array();
foreach ($new_nco->getSkillTables() as $table => $value ) {
    $doc['SkillTables'][] = $table;
}
*/

// $user['username'] = $_Post['username'];
// $user['userpassword'] = $_POST['password'];

$doc['Name'] = $_POST['firstname'] . " " . $_POST['lastname'];
$doc['UPP'] = $_POST['UPP'];

$collection->insert($doc);

header('Location: addCharacterForm.html');


