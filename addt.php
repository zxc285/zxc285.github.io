<!DOCTYPE html>

<?php
include "../connect.php";
$rowcount = 0;

// Use null coalescing operator to avoid undefined index warnings
$name = $_POST['vname'] ?? '';
$url = $_POST['vURL'] ?? '';
$date = $_POST['date'] ?? '';

// Check if required fields are not empty
if ($name !== '' && $url !== '') {
    $sql = "INSERT INTO vods(vname, vURL,date) VALUES('$name','$url','$date')";
    echo 'sql:' , $sql . '<br>';

    // Execute the query
    $result = mysqli_query($lngwiki_db, $sql);

    // Check if the query was successful
    if ($result) {
        echo '新增成功';
        header('Location: ../index.php');
        exit; // Ensure script stops after redirection
    } else {
        echo 'Error: ' . mysqli_error($lngwiki_db); // Print any SQL error
    }
} else {
    echo 'Error: Required fields are missing.';
}
?>
