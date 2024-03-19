<?php

require_once "../config.php";

// Check if the bill_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the bill_id from the URL and sanitize it
    $bill_id = intval($_GET['id']);

    // Disable foreign key checks
    $disableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=0;";
    mysqli_query($link, $disableForeignKeySQL);

    // Construct the DELETE query with a parameterized query
    $deleteSQL = "DELETE FROM bills WHERE bill_id = ?";

    // Prepare the DELETE query
    if ($stmt = mysqli_prepare($link, $deleteSQL)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $bill_id);

        // Execute the DELETE query
        if (mysqli_stmt_execute($stmt)) {
            
            header("location: ../panel/bill-panel.php");
            exit();
        } else {
           
            echo "Error: " . mysqli_error($link);
        }

      
        mysqli_stmt_close($stmt);
    } else {

        echo "Error: " . mysqli_error($link);
    }


    $enableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=1;";
    mysqli_query($link, $enableForeignKeySQL);

 
    mysqli_close($link);
}
?>
