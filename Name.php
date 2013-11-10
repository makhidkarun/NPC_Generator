<?php

namespace NPC_Generator;

class Name
{

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function generate($culture, $gender){
        $knownCultures = array('humaniti');
        $knownGenders = array('male', 'female');

        $culture = trim($culture);
        if (! in_array($culture, $knownCultures)){ 
            $culture = 'humaniti';
        }

        $gender = trim($gender);
        if (! in_array($gender, $knownGenders)){
            $gender = 'male';
        }

        $lastName = $this->fetchRandomName($culture . '_last');
        $firstName = $this->fetchRandomName($culture . '_' . $gender . '_first');
        return $firstName . ' ' . $lastName;
    }
    
    private function fetchRandomName($table)
    {
        $sql = "SELECT * from $table ORDER BY RANDOM() LIMIT 1";
        $stmt = $this->dbh->query($sql);
        $result = $stmt->fetch();
        return $result['name'];
    }

}
/*
try { 
    $dbh = new \PDO("sqlite:names.db");
    $nameGenerator = new Name($dbh);
    $hisName = $nameGenerator->generate('humaniti', 'male');
    $herName = $nameGenerator->generate('humaniti', 'female');
    echo "{$hisName} and {$herName}\n";
} catch(PDOException $e) {
    echo $this->e->getMessage();
    exit;
}
*/
