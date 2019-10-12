<?php
spl_autoload_register("autoload");

function autoload(string $class) {
    $file = "classe/".strtolower($class).".class.php";
    if (file_exists($file)) {
        require_once $file;
    } 
    else{
        throw new Exception("le fichier $file n'existe pas");
    }
}