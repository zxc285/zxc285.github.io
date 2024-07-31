<!DOCTYPE html>

<?php
include "../connect.php";
if (empty($_GET['id'])) {
    die('請輸入 id');
}
$id = $_GET['id'];
$rowcount = 0;

// Use null coalescing operator to avoid undefined index warnings
$hh = isset($_POST['hh']) ? (int)$_POST['hh'] : 0;
$mm = isset($_POST['mm']) ? (int)$_POST['mm'] : 0;
$ss = isset($_POST['ss']) ? (int)$_POST['ss'] : 0; // 默認值為 0

// $id = $_POST['v_id'] ?? '';
$word = $_POST['word'] ?? '';
$time = ($hh * 3600) + ($mm * 60) + $ss;
$name = '';

// Check if required fields are not empty
if ($id !== '' && $word !== '') {
    $nameQuery = "SELECT vname FROM vods WHERE v_id = '$id'";
    $nameResult = mysqli_query($lngwiki_db, $nameQuery);
    
    if ($nameResult && mysqli_num_rows($nameResult) > 0) {
        $nameRow = mysqli_fetch_assoc($nameResult);
        $name = $nameRow['vname'];
    } else {
        echo 'Error: Name not found for the given ID.';
        exit; // Stop script if name not found
    }
    $sql = "INSERT INTO keyword(v_id, word, timeline) VALUES('$id', '$word', '$time')";
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
