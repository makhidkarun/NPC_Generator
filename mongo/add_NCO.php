<?php


require_once 'autoload.php';

$m = new MongoClient();
$db = $m->traveller;
$collection = $db->npcs;

$doc = array();

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

$collection->insert($doc);


