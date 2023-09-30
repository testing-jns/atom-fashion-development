<?php

namespace core;

use \PDO;
use \PDOException;

class Database {
    private string $dbms = DB_DBMS;
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbnm = DB_NAME;

    private object $dbh;
    private object $stmt;

    private string $error_message = "";
    private bool $query_status = true;
    private $db_conn_success = false;


    
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
        
        // Database error detected!
        $this->__destruct();
    }

    public function databaseConnection() {
        return $this->db_conn_success;
    }

    public function __construct() {
        try {
            $this->connect();
            $this->db_conn_success = true;
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

    public function bindValue(...$args) : Database {
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
        try {
            $this->stmt->execute();
        } catch (PDOException $pdo_exc) {
            $this->query_status = false;
            $this->error_message = $pdo_exc->getMessage();
        }

        return $this;
    }

    public function status() : bool {
        return $this->query_status;
    }

    public function error_message() : string {
        return $this->error_message;
    }

    public function result() {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function resultAll() : array {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount() : int {
        return $this->stmt->rowCount();
    }

    public function __destruct() {
        unset($this->dbh);
    }

}
