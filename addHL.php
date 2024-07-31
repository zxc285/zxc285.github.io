<!DOCTYPE html>

<?php
include "../connect.php";
if (empty($_GET['id'])) {
    die('請輸入 id');
}
$id = $_GET['id'];
$rowcount = 0;

// Use null coalescing operator to avoid undefined index warnings
// $id = $_POST['v_id'] ?? '';
$uname = $_POST['uName'] ?? '';
$date = $_POST['uDate'] ?? '';
$creator = $_POST['creator'] ?? '';
$URL = $_POST['URL'] ?? '';
$name = '';
// Check if required fields are not empty
if ($id !== '' ) {
    $nameQuery = "SELECT vname FROM vods WHERE v_id = '$id'";
    $nameResult = mysqli_query($lngwiki_db, $nameQuery);
    
    if ($nameResult && mysqli_num_rows($nameResult) > 0) {
        $nameRow = mysqli_fetch_assoc($nameResult);
        $name = $nameRow['vname'];
    } else {
        echo 'Error: Name not found for the given ID.';
        exit; // Stop script if name not found
    }
    $sql = "INSERT INTO unofficial_highlight(v_id, uName ,uDate, creator, URL) VALUES('$id', '$uname','$date','$creator', '$URL' )";
    echo 'sql:' , $sql . '<br>';

    // Execute the query
    $result = mysqli_query($lngwiki_db, $sql);

    // Check if the query was successful
    if ($result) {
        echo '新增成功';
        header("Location: ../test.php?id=$id"."&searchText=" . urlencode($name) . "&action=sent");
        exit; // Ensure script stops after redirection
    } else {
        echo 'Error: ' . mysqli_error($lngwiki_db); // Print any SQL error
    }
} else {
    echo 'Error: Required fields are missing.';
}
?>
