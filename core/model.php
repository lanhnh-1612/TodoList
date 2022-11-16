<?php

class Model
{
    protected $dbHost;
    protected $dbName;
    protected $dbbUser;
    protected $dbPass;
    protected $dbPort;
    protected $dbConn;

    function __construct()
    {
        $this->dbHost = DB_HOST;
        $this->dbName = DB_NAME;
        $this->dbUser = DB_USER;
        $this->dbPass = DB_PWD;
        $this->dbPort = DB_PORT;

        $this->dbConn = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPass);
        if (!$this->dbConn) {
            $this->error('Error connect db');
        }
    }

    function query($query)
    {
        try {
            if (!$query)
                return false;
            $stmt = $this->dbConn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function error($message)
    {
        echo $message . ":";
        exit;
    }
}
