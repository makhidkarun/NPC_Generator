<?php

/**
 *     Being.php
 * 
 *   To be implemented in various ways.
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
 * @link        github.com/makhidkarun/Traveller_Mercenary_Generator/blob/master/Being.php
 * @see         huh?
 * @since       2013
 * 
*/

namespace NPC_Generator;

abstract class Being
{
    public $stats = array('Str' => 0, 'Dex' => 0, 'End' => 0, 'Int' => 0, 'Edu' => 0, 'Soc' => 0);
    protected $skills = array();
    protected $upp;
    protected $name;
    protected $age;
    protected $gender;
    protected $awards = array();
    public $skill_tables = array();

    protected function setAge($min, $max)
    {
        return mt_rand($min, $max);
    }

    public function getAge()
    {
        return $this->age;
    }

    protected function setGender($percent_male)
    {
        $gender = 'female';
        $roll = mt_rand(1, 100);
        if ($roll <= $percent_male) {
            $gender = 'male';
        }
        return $gender;
    }
    
    public function getGender()
    {
        return $this->gender;
    }
   
    protected function setName($race, $gender)
    {
        try {
            $dbh = new \PDO("sqlite:names.db");
            $nameGenerator = new Name($dbh);
            $name = $nameGenerator->generate($race, $gender);
        } catch (PDOException $e) {
            echo $this->e->getMessage();
            exit;
        }
        return $name;
    }
       
    public function getName()
    {
        return $this->name;
    }
    
    protected function setStats(&$stats)
    {
        foreach ($stats as $stat => $value) {
            $die = new Dice();
            $stats[$stat] = $die->rollDice(2, 1, 6);
        }
        return $stats;
    }

    public function getStat($stats, $stat)
    {
        return $stats[$stat];
    }

    public function getStatHex($stats, $stat)
    {
        return strtoupper(dechex($stats[$stat]));
    }

    protected function setUpp($stats)
    {
        $upp = '';
        reset($stats);
        while (list($k, $v) = each($stats)) {
            $upp = $upp . strtoupper(dechex($stats[$k]));
        }
        return $upp;
    }

    public function getUpp()
    {
        return $this->upp;
    }
       
    public function raiseStat(&$stats, $stat_to_raise, $raise_by)
    {
        // Max stat is 15
        if ($stats[$stat_to_raise] < 15) {
            $stats[$stat_to_raise] += $raise_by;
        }
        return $stats;
    }
 
    public function addSkill(&$skills, $skill)
    {
        if (array_key_exists($skill, $skills)) {
            $skills[$skill] += 1;
        } else {
            $skills[$skill] = 1;
        }
        return $skills;
    }

    public function getSkills()
    {
        return $this->skills;
    }
   
    public function chooseSkill ($skill_array, $skill_tables)
    {
        // There are a lot of modifiers to this stuff.
        // Maybe break it up so that the table is chosen
        //  and then the modifiers applied?
        // Must take into account the max on the table
        //  as well as rank, etc.
        $roll = mt_rand(1, 6);
        $rand_table = array_rand($skill_tables);
        $skill = $skill_array[$rand_table][$roll];
        return $skill;
    }

    public function addAward(&$awards, $award)
    {
        if (array_key_exists($award, $awards)) {
            $awards[$award] += 1;
        } else {
            $awards[$award] = 1;
        }
        return $awards;
    }

    public function getAwards()
    {
        return $this->awards;
    }

    public function addMedal(&$awards, $medal)
    {
        if (array_key_exists($medal, $awards['medal'])) {
            $awards['medal'] += 1;
        } else {
            $awards['medal'] = 1;
        }
    }

    public function addSkillTables(&$skill_tables, $table)
    {
        $skill_tables[$table] = 0;
        return $skill_tables;
    }

    public function getSkillTables()
    {
        return $this->skill_tables;
    }
}
