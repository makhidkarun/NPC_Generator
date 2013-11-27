<?php

/**
 * Trooper.php
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
 * @link        github.com/makhidkarun/NPC_Generator/blob/master/Trooper.php
 * @see         Notes from MANCHUCK on ##phpmentoring
 * @see         https://gist.github.com/manchuck/6952598
 * @see         http://pastebin.com/3DQuBf1q
 * @since       Original copyright date
 * 
*/

namespace NPC_Generator;

class Trooper extends Being
{

    private $rank;
    private $mos;
    private $min_age;
    private $max_age;
    private $min_rank;
    private $max_rank;
    private $rank_group;
    private $rank_roll;
    private $mercenaryMedals = array();
    // private $combatServiceRibbons;

    public function __construct(MilitaryRoleAbstract $role)
    {
        global $mercenary_skills, $person_params;
        require_once 'mercenary_skills.php';

        $this->gender = $this->setGender(50);
        $this->name =  $this->setName('humaniti', $this->gender);
        $this->stats = $this->setStats($this->stats);
        $this->years_of_service = mt_rand(1, 20); 
        $this->age = $this->years_of_service + 17;
        $rank_roll = intval(mt_rand(($this->years_of_service/4), ($this->years_of_service/2)));
        $this->rank_group = 'enlisted';
        $this->rank = $this->setRank($this->rank_group, $rank_roll);

        // Set the MOS and list of skill tables to choose from
        $this->mos = $this->setMos();
        $this->skill_tables = $this->addSkillTables($this->skill_tables, 'ArmyLife');
        $mos_table = 'MOS_' . $this->mos;
        $this->skill_tables = $this->addSkillTables($this->skill_tables, $mos_table);
        if ($this->rank_group == 'enlisted' && $rank_roll > 2) {
            $this->skill_tables = $this->addSkillTables($this->skill_tables, 'NCO');
        }
        // Start adding skills
        $this->skills = $this->addSkill($this->skills, 'GunCbt');
        $num_skills = $rank_roll / 2;
        for ($i = 0; $i <= $num_skills; $i++) {
            $rand_table = array_rand($this->skill_tables);
            if ($rand_table == 'ArmyLife' && $this->rank_group == 'officer') {
                $modifier = intval($rank_roll/3);
            } elseif ($rand_table == 'NCO' && $rank_roll > 4) {
                $modifier = $rank_roll - 4;
            } else {
                $modifier = 0;
            }

            $new_skill = $this->chooseSkill($mercenary_skills, $rand_table, $modifier);
            if ($new_skill[0] == '+') {
                $stat_to_increase = str_replace('+1 ', '', $new_skill);
                $this->raiseStat($this->stats, $stat_to_increase, 1);
            } else {
                $this->skills = $this->addSkill($this->skills, $new_skill);
            }
        }
        // Final UPP after stats potentially altered.
        $this->upp = $this->setUpp($this->stats);

        $this->awards['CombatServiceRibbons'] = $this->setCombatServiceRibbons($this->age);
        $this->awards['WoundBadges'] = $this->setWoundBadges($this->awards['CombatServiceRibbons']);
        $this->awards['Medals'] = array();
        $this->setMedals($this->awards);

    }

   
    protected function chooseSkill($skills, $table, $modifier) {
        $max_roll = count($table);
        $roll = mt_rand(1, 6) + $modifier;
        if ($roll > $max_roll) {
            $roll = $max_roll;
        }
        return $skills[$table][$roll];
    }
         
    protected function setMedals(&$awards)
    {
        $mod = 0;
        $medal = new Decoration;
        if (array_key_exists('CombatServiceRibbons', $awards)) {
            $mod += ($awards['CombatServiceRibbons'] * 2);
        }
        if (array_key_exists('WoundBadges', $awards)) {
            $mod += ($awards['WoundBadges']);
        }
        $newMedal = $medal->getMercenaryMedals($mod);
        if (array_key_exists($newMedal, $awards['Medals'])) {
            $awards['Medals'][$newMedal] += 1;
        } else {
            $awards['Medals'][$newMedal] = 1;
        }
    }

    protected function setWoundBadges($csr)
    {
        $wb = new Decoration;
        return $wb->getWoundBadges($csr);
    }
        
    protected function setCombatServiceRibbons($mod)
    {
        $csr = new Decoration;
        return $csr->getCombatServiceRibbons($mod);
    }
    
    public function getCombatServiceRibbons()
    {
        return $this->awards['CombatServiceRibbons'];
    }
 
    protected function setRank($rank_group, $rank_roll)
    {
        // This global will go away when I have a db for it.
        require 'imperial_ranks.php';
        if ($rank_roll < 1) {
            $rank_roll = 1;
        } elseif ( $rank_roll > count($ranks[$rank_group])) {
            $rank_roll = count($ranks[$rank_group]);
        }
        return $ranks[$rank_group][$rank_roll];
    }
       
    public function getRank()
    {
        return $this->rank;
    }

    protected function setMos()
    {
        $mos_list = array('Infantry', 'Cavalry');
        $mos_roll = mt_rand(0, 1);
        $mos = $mos_list[$mos_roll];
        return $mos;
    }
    
    public function getMos()
    {
        return $this->mos;
    }
}
