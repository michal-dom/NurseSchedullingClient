<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 14:50
 */

class Connection
{
    private static $instance;
    private $pdo;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct(){
        try {
            $this -> pdo = new PDO('mysql:host=localhost;dbname=schedule', 'root', '');
            $this -> pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "sukces";
        } catch(PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }
    }

    public function getPdo(){
        return $this->pdo;
    }

}