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
        require_once 'person_params.php';

        $this->gender = $this->setGender(50);
        $this->name =  $this->setName('humaniti', $this->gender);
        $this->stats = $this->setStats($this->stats);
        $this->upp = $this->setUpp($this->stats);
        $rank_roll = mt_rand($role->getMinRank(), $role->getMaxRank());
        $this->age = $this->setAge($role->getMinAge(), $role->getMaxAge()) + $rank_roll;
        $this->rank = $this->setRank($role->getRankGroup(), $rank_roll);

        // Set the MOS and list of skill tables to choose from
        $this->mos = $this->setMos();
        $this->skill_tables = $this->addSkillTables($this->skill_tables, 'ArmyLife');
        $mos_table = 'MOS_' . $this->mos;
        $this->skill_tables = $this->addSkillTables($this->skill_tables, $mos_table);
        if (count($role->additionalSkillTables) > 0) {
            foreach ($role->additionalSkillTables as $key => $value) {
                $this->skill_tables = $this->addSkillTables($this->skill_tables, $value);
            }
        }

        // Start adding skills
        $this->skills = $this->addSkill($this->skills, 'GunCbt');
        $num_skills = $rank_roll / 2;
        for ($i = 0; $i <= $num_skills; $i++) {
            $new_skill = $this->chooseSkill($mercenary_skills, $this->skill_tables);
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

    
    protected function setMedals(&$awards)
    {
        $mod = 0;
        $medal = new Decoration;
        if (array_key_exists('CombatServiceRibbons', $awards)){
            $mod += ($awards['CombatServiceRibbons'] * 2);
        }
        if (array_key_exists('WoundBadges', $awards)){
            $mod += ($awards['WoundBadges']);
        }
        $newMedal = $medal->getMercenaryMedals($mod);
        if (array_key_exists($newMedal, $awards['Medals'])){
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
