<?php

class db{
    //properties
    private $dbhost = 'localhost';
    private $dbuser  ='root';
    private $dbpass = '';
    private $dbname = 'slimproject';
 
    //connection

    public function connection(){     
        
        $mysql = "mysql:host = $this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql,$this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        return $dbConnection;
        
    }
}