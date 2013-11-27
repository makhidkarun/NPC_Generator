<?php

/**
 * Decoration.php
 * 
 * To be implemented in various ways.
 *
 * PHP Version 5
 * 
 * License: This is open source code of some license I don't yet know.
 * 
 * @category    Games
 * @package     Makhidkarun
 * @author      Leam Hall <leamhall@gmail.com>
 * @copyright   2012-2013 Leam Hall
 * @license     license 1 <http://LICENSEURL.example.com>
 * @version     GIT: 0.2
 * @link        github.com/makhidkarun/NPC_Generator/blob/master/Decoration.php
 * @see         huh?
 * @since       Original copyright date
 * 
*/

namespace NPC_Generator;

class Decoration
{
    private $die;

    public function __construct()
    {
   
        $this->die = new Dice;
    }
    
    public function getCombatServiceRibbons($mod)
    {
        // Assume $mod is Age + Rank Roll
        $roll = $this->die->rollDice(2, 1, 6);
        $combatServiceRibbons = ($roll - 4) / 4;
        $combatServiceRibbons = $combatServiceRibbons + (($mod - 18) / 4);
        $csr =  intval($combatServiceRibbons);
        if ($csr < 0) {
            $csr = 0;
        }
        return $csr;
    }

    public function getWoundBadges($csr)
    {
        $roll = $this->die->rollDice(2, 1, 6) + $csr;
        $wb = intval(($roll - 7) / 4);
        if ($wb < 0) {
            $wb = 0;
        }
        return $wb;
    }
        
    public function getMercenaryMedals($mod)
    {
        // Assume $mod is Combat Service Ribbons + Wound Badges
        $roll = $this->die->rollDice(2, 1, 6) + $mod;
        $mercenaryMedals = array('MCUF', 'MCG', 'SEH');
        if ($roll > 20) {
            return $mercenaryMedals[2];
        } elseif ($roll > 16) {
            return $mercenaryMedals[1];
        } elseif ($roll > 12) {
            return $mercenaryMedals[0];
        } else {
            return '';
        }
    }
}
