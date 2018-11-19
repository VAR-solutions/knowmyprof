<?php
require('config.php');

if(isset($_REQUEST["term"])){
    $key = $_GET['term'];
    $sql = "SELECT * FROM prof WHERE (fname LIKE '%{$key}%') OR (lname LIKE '%{$key}%') OR (email LIKE '%{$key}%') OR (web LIKE '%{$key}%') OR (aoi LIKE '%{$key}%') OR (qual LIKE '%{$key}%') OR (achi LIKE '%{$key}%')";
    
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["fname"] . " " . $row["lname"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
?>