<?php

try{
    
    $db = new PDO('mysql:host=localhost;', 'itbois','Password@123');
    $sql = file_get_contents('data/init.sql');
    $qr = $db->exec($sql);
    echo "Database Created";
} catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
}

?>
