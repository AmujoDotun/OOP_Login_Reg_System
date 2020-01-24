<?php 
function escape($string){
    //escaping the htmlentity, ENT_QUOTES Escape singular and double quote UTF-8 is for the character encoding
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}