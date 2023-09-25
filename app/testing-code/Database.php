<?php

require_once "../config/database.config.php";

class Database {
    private string $dbms = "mysql";
    private string $host = "192.168.1.111";
    private string $user = "root";
    private string $pass = "jns123";
    private string $dbnm = "atom_fashion";

    private object $dbh;
    private object $stmt;


    
    private function connect() : void {
        $dsn = "$this->dbms:host=$this->host;dbname=$this->dbnm;charset=UTF8";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    }

    private function error_report(object $pdo_exc) : void {
        date_default_timezone_set("Asia/Jakarta");
        $db_error_date = date("Y m d - H:i:s e");
        $db_error_mess = $pdo_exc->getMessage();
        $db_error_report = "Datetime : $db_error_date \nMessage : $db_error_mess \n\r";
        file_put_contents(DB_FILE_LOGS, $db_error_report, FILE_APPEND);
        die("Database error detected!");
    }

    public function __construct() {
        try {
            $this->connect();
        } catch (PDOException $pdo_exc) {
            $this->error_report($pdo_exc);
        }
    }

    public function query(string $sql) : Database {
        $this->stmt = $this->dbh->prepare($sql);
        return $this;
    }

    private function bindValueTypeData($value) {
        switch (true) {
            case is_string($value):
                return PDO::PARAM_STR;
            case is_int($value):
                return PDO::PARAM_INT;
            case is_bool($value):
                return PDO::PARAM_BOOL;
            case is_null($value):
                return PDO::PARAM_NULL;
        }
    }

    public function bindValue(string|array ...$args) : Database {
        if (count($args) > 1) {
            $this->stmt->bindValue($args[0], $args[1], $this->bindValueTypeData($args[1]));
            return $this;
        }

        foreach ($args[0] as $key => $item) {
            $this->stmt->bindValue($key, $item, $this->bindValueTypeData($item));
        }
        
        return $this;
    }

    public function execute() : object {
        $this->stmt->execute();
        return $this;
    }

    public function result() : object {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function resultAll() : array {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount() : int {
        return $this->stmt->rowCount();
    }

}