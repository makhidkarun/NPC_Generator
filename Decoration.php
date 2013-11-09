<?php

namespace NPC_Generator;

class Decoration
{
    // private $combatRibbons;
    // private $woundBadges;
    private $die;

    public function __construct(){
   
        $this->die = new Dice;
    } 
    
    public function getCombatServiceRibbons($mod){
        // Assume $mod is Age + Rank Roll
        $roll = $this->die->rollDice(2,1,6);
        $combatServiceRibbons = ($roll - 4) / 4;
        $combatServiceRibbons = $combatServiceRibbons + (($mod - 18) / 4);
        return intval($combatServiceRibbons);
    }

    public function getMercenaryMedal($mod){
        // Assume $mod is Age + Rank Roll + CombatRibbons
        $mod = ($mod - 17) / 4;
        $roll = $this->die->rollDice(2,1,6) + $mod;
        $mercenaryMedals = array('MCUF', 'MCG', 'SEH');
        if ($roll > 20){
            return $mercenaryMedals[2];
        } else if ($roll > 16) {
            return $mercenaryMedals[1];
        } else if ($roll > 12) {
            return $mercenaryMedals[0];
        } else {
            return '';
        }
    }
}
             
        
        
 
