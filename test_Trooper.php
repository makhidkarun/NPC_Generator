<?php

require_once 'autoload.php';

function newTroopTxt($newGuy){

    $desc = "The new ";
    $desc .= $newGuy->getMos();
    $desc .= " ";
    $desc .= $newGuy->getRank();
    $desc .= ", ";
    $desc .= $newGuy->getName();
    $desc .= ", is a ";
    $desc .=  $newGuy->getAge(); 
    $desc .=  " year old "; 
    $desc .= $newGuy->getGender();
    $desc .= " with a ";
    $desc .= $newGuy->getUpp();
    $desc .= " UPP";
    $desc .= ".\n";

    echo "$desc";
    foreach ($newGuy->getSkills() as $skill => $level) {
        echo "$skill : $level\n";
    }   

    echo "Skill tables: ";

    foreach ($newGuy->getSkillTables() as $table => $value ) {
        echo "$table ";
    }
    echo "\n";
}

$newGuy = new \NPC_Generator\Trooper(new \NPC_Generator\NCOParams);
newTroopTxt($newGuy);

$newGuy = new \NPC_Generator\Trooper(new \NPC_Generator\TrooperParams);
newTroopTxt($newGuy);
