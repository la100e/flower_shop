<?php
    try{
        $connect = new PDO('mysql:host=localhost;dbname=flower shop', 'root', '');
    }catch(PDOException $e){
        echo($e->getMessage());
        exit;
    }
?>