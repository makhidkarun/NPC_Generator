<?php

namespace NPC_Generator;

class Name
{
    public $name;
    protected $dbh;
    private $sql;
    private $stmt;
    private $countResult;
    private $count;
    private $roll;
    private $lastTable;
    private $lastName;
    private $firstTable;
    private $firstName;
    private $e;

    
    public function __construct($culture, $gender)
    {
        try { 
            $this->dbh = new UniversalConnect::PDO("sqlite:names.db");
        } catch(PDOException $e) {
            echo $this->e->getMessage();
            exit;
        }

   // function getName($dbh, $culture, $gender){
        $this->lastTable = trim($culture . '_last');
        $this->sql = ("SELECT count(*) as count from $lastTable");
        $this->stmt = $this->dbh->query($sql);
        $this->countResult = $this->stmt->fetch();
        $this->count = $this->countResult['count'] - 1;
        $this->roll = mt_rand(0, $this->count);
        $this->sql = ("SELECT * from $this->lastTable WHERE rowid = $this->roll");
        $this->stmt = $this->dbh->query($this->sql);
        $this->result = $this->stmt->fetch();
        $this->lastName = $this->result['name'];

        $this->firstTable = trim($culture . '_'. $gender . '_first' );
        $this->sql = ("SELECT count(*) as count from $this->firstTable");
        $this->stmt = $this->dbh->query($this->sql);
        $this->countResult = $this->stmt->fetch();
        $this->count = $this->countResult['count'] - 1;
        $this->roll = mt_rand(0, $this->count);
        $this->sql = ("SELECT * from $this->firstTable WHERE rowid = $this->roll");
        $this->stmt = $this->dbh->query($this->sql);
        $this->result = $this->stmt->fetch();
        $this->firstName = $this->result['name'];
    
        $this->dbh = null;
        return $this->firstName . ' ' . $this->lastName;
    }
}


