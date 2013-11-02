<?php

/**
 * Dice.php
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
 * @link        github.com/makhidkarun/NPC_Generator/blob/master/Dice.php
 * @see         huh?
 * @since       Original copyright date
 * 
*/

namespace NPC_Generator;

class Dice
{

    public function rollDice($num_dice, $die_min, $die_max)
    {
        $total = 0;
        for ($i = 1; $i <= $num_dice; $i++) {
            $total += mt_rand($die_min, $die_max);
        }
        return $total;
    }

    public function generateUpp()
    {
        $upp = '';
        for ($i = 1; $i <= 6; $i++) {
            $stat_roll = $this->roll_dice(2, 1, 6);
            $stat = strtoupper(dechex($stat_roll));
            $upp = $upp . $stat;
        }
        return $upp;
    }
}
