<?php

class Config{
    public static function get($path){
        if($path){
            $config =$GLOBALS['config'];
            $path = explode('/', $path);
//looping through each bit in Config in index.php
            foreach ($path as $bit) {
                //check if the bit are set in the config
                if(isset($config[$bit])){
                    $config = $config[$bit];
                }
            }
            return $config;
        }
        return false;
    }
}