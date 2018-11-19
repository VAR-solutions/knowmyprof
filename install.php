<?php

try{
    
    $db = new PDO('mysql:host=localhost;', 'itbois','Password@123');
    $sql = file_get_contents('data/init.sql');
    $qr = $db->exec($sql);
    echo "Database Created";
} catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
}





// try {
    // $connection = new PDO("mysql:host=$host", $username, $password, $options);
    // $db = mysqli_connect('localhost', 'root', 'password', 'it');
    //database configuration
//   require ('config.php');

//     $sql = file_get_contents("data/init.sql");
//     $db->exec($sql);

//     echo "Database and table users created successfully.";
// } catch(PDOException $error) {
//     echo $sql . "<br>" . $error->getMessage();
// }
?>
