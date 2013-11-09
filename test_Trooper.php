<?php

require_once 'autoload.php';

function newTroopTxt($newGuy){
    $desc = '';
    $desc .= $newGuy->getRank();
    $desc .= " (";
    $desc .= $newGuy->getMos();
    $desc .= ") ";
    $desc .= $newGuy->getName();
    $desc .= ", ";
    $desc .=  $newGuy->getAge(); 
    $desc .=  ", "; 
    $desc .= $newGuy->getGender();
    $desc .= "\n";
    $desc .= $newGuy->getUpp();
    $desc .= "\n";
    $desc .= "Combat Service Ribbons: ";
    $desc .= $newGuy->getCombatServiceRibbons();
    $desc .= "\n";

    echo "\n";
    echo "$desc";
    foreach ($newGuy->getSkills() as $skill => $level) {
        echo "$skill - $level ";
    }   

    echo "\n";
    /*
    echo "Skill tables: ";
    foreach ($newGuy->getSkillTables() as $table => $value ) {
        echo "$table ";
    }
    */
    echo "\n";
}

$newGuy = new \NPC_Generator\Trooper(new \NPC_Generator\NCOParams);
newTroopTxt($newGuy);

$newGuy = new \NPC_Generator\Trooper(new \NPC_Generator\TrooperParams);
newTroopTxt($newGuy);
