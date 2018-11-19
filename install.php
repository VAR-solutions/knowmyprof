<?php

try{
    // $connection = new PDO("mysql:host=$host", $hostname, $hostpwd, $options);
    
    // require('config.php');
    $host = "localhost";
$hostname = "itbois";
$hostpwd = "Password@123";
$dbname = "it";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
$connection = new PDO($dsn,$hostname,$hostpwd,$options);

    $sql = file_get_contents("data/init.sql");
    $connection->exec($sql);
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
