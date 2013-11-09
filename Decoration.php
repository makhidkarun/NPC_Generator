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
        $csr =  intval($combatServiceRibbons);
        if ( $csr < 0){
            $csr = 0;
        }
        return $csr;
    }

    public function getWoundBadges($csr){
        $roll = $this->die->rollDice(2,1,6) + $csr;
        $wb = intval(($roll - 7) / 4);
        if ($wb < 0){
            $wb = 0;
        } 
        return $wb;
    }
        
    public function getMercenaryMedals($mod){
        // Assume $mod is Combat Service Ribbons + Wound Badges
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
             
        
        
 
