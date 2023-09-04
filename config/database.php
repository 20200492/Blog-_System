<?php

define('user','root');
define('password','');

try{

    $dsn='mysql:host=localhost;dbname=blog system';

    $pdo= new PDO($dsn,user,password);

}
catch (PDOException $e){

    echo"failed to connect ".$e->getMessage();
}

?>