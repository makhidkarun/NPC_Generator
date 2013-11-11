<?php
// namespace NPC_Generator;
ini_set("display_errors", "1");
ERROR_REPORTING(E_ALL);

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
    $awards = $newGuy->getAwards();
    if (array_key_exists('Medals', $awards)){
        if (array_key_exists('SEH', $awards['Medals'])){
            $desc .= "SEH: " . $awards['Medals']['SEH'] . " ";
        } 
        if (array_key_exists('MCG', $awards['Medals'])){
            $desc .= "MCG: " . $awards['Medals']['MCG'] . " ";
        } 
        if (array_key_exists('MCUF', $awards['Medals'])){
            $desc .= "MCUF: " . $awards['Medals']['MCUF'] . " ";
        }
    } 
    if (array_key_exists('CombatServiceRibbons', $awards)){
        if ($awards['CombatServiceRibbons'] > 0) {
            $desc .= "Combat Service Ribbons: " . $awards['CombatServiceRibbons'] . " ";
        }
    }
    if (array_key_exists('WoundBadges', $awards)){
        if ($awards['WoundBadges'] > 0) {
            $desc .= "Wound Badges: " . $awards['WoundBadges'] . " ";
        }
    }
    $desc .= "\n";

    echo "\n";
    echo "$desc";
    foreach ($newGuy->getSkills() as $skill => $level) {
        echo "$skill - $level ";
    }   

    echo "\n";
    echo "\n";
}

$newGuy = new Trooper(new NCOParams);
newTroopTxt($newGuy);
/*
$newGuy = new Trooper(new TrooperParams);
newTroopTxt($newGuy);
*/
