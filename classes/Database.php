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

public function query($sql, $params = array()){
    $this->_error = false;
    if($this->_query = $this->_pdo->prepare($sql)){
        $x = 1;
        //check if parameters exist
        if(count($params)){
            foreach($params as $param){
                $this->_query->bindValue($x, $param);
                $x++;
            }
        }
        if($this->_query->execute()){
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            $this->counts = $this->_query->rowCount();
        }else{
            $this->error = true;
        }
    }
    //return current obj
    return $this;
}
public function action($action, $table, $where =array()){
    if(count($where) === 3){
        $operators = array('=', '>', '<', '>=', '<=');

        $field      = $where[0];
        $operator   = $where[1];
        $value      = $where[2];

        //check if operator is inside the array
        if(in_array($operator, $operators)){
            // the sql code below is same as $sql = "SELECT * FROM user WHERE username='Dotun'";
            $sql = "{$action} FROM {$table} WHERE {$field} {operator} ?";

            if(!$this->query($sql, array($value))->error()){
                return $this;
            }
        }
    }
    return false;
}


public function get($table, $where){
    return $this->action('SELECT *', $table, $where);
}
public function delete($table, $where){
    return $this->action('DELETE', $table, $where);
}
public function error(){
    return $this->_error;
}

public function count(){
    return $this->_count;
}
}