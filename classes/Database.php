<?php

class Database{
    private static $_instance =null;
    private $_pdo,
            $_query, 
            $_error =false, 
            $_results, 
            $_count =0;

private function __construct(){
    try{

        //setting the PDO connection
         $this->_pdo = new PDO('mysql:host='. 
         Config::get('mysql/host') .';$dbname='. 
         Config::get('mysql/db'), 
         Config::get('mysql/username'), 
         Config::get('mysql/password'));

         echo 'connected';
        
    }catch(PDOException $e){
        //if there is an error kill the app and output the message
        die($e->getMessage());
    }
}

public static function getInstance(){
    //checking if there is an instance is set already, if not set new one
    if(!isset(self::$_instance)){
        self::$_instance = new Database();
    }
    return self::$_instance;
}
}