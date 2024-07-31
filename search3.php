<!DOCTYPE html>

<?php
include "connect.php";
$i = 0;
$rowcount = 0;
$flag = 0;
if (isset($_REQUEST['action'])) {

    if ($_REQUEST['action'] == 'sent') {
        $input_text = trim($_REQUEST['searchText']);
        if($input_text == "")
        {
            echo "<script>alert('Please input title');history.go(-1);</script>";
        }else{
            $flag = true;
        }
        $sql = "SELECT *
        FROM keyword
        JOIN vods ON keyword.v_id = vods.v_id
         WHERE word LIKE '%".$input_text."%'";
        $result = mysqli_query($lngwiki_db, $sql);
        $rowcount = mysqli_num_rows($result);
    }
}
?>

<html lang="en">

<head>
<meta charset="UTF-8">
    <title>LNG wiki</title>
    <link rel="icon" href="https://yt3.googleusercontent.com/ytc/AIdro_kv_7s9xm0c-PgXHTPn4vq3hywtPyQRAtqLPS0j_a_0Xw=s176-c-k-c0x00ffffff-no-rj">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" type="text/css">

</head>

<body>
    <div class="page">
        
        <div class="sidebar">
            <div class="title">搜尋關鍵字</div>
            <div class="navbar-nav">
                <div class="nav-item" >
                    <a class="nav-link" href="index.php">首頁</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="search3.php">搜尋關鍵字</a>
                </div>
            </div>
        </div>
        <div class="center-container">
                <form>
                    <div class="input-group mb-3">
                        
                        <input type="text" name="searchText" class="form-control" id="itemInput" value="" placeholder="請輸入標題">
                        <input type="hidden" name="action" value="sent">
                        <input type="submit" value="Search" class="btn btn-outline-primary">             
                    </div>
                </form>   
            </div>
        <div class="container">            
            <table class="table table-bordered">
                <thead align='center' valign="middle">
                    <tr>
                        <th>標題</th>
                        <th>關鍵字</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    if($flag)
                    {
                        echo "$input_text";   
                    }
                    if ($rowcount > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_arr[$i] = $row['v_id'];
                            $time_arr[$i] = $row['timeline'];
                            $name_arr[$i] ="<a class='table-link' href='test.php?id=".$row['v_id']. "&searchText=" . urlencode($row['vname']) . "&action=sent" . "'>" . $row['vname'] . "</a>";

                            $vURL_arr[$i] = "<a  class='table-link'href='" .  $row['vURL'] .'&t='. $time_arr[$i]. "'>" .$row['word']."</a>";
                            $word_arr[$i] = $row['word'];
                            echo "
                                    <tr>
                                        <th>$name_arr[$i]</th>
                                        <th>$vURL_arr[$i]</th>
                                    </tr>";

                            $i++;
                        }
                    }else{

                    }

                    ?>
                </tbody>

            </table>

        </div>
    </div>


    <script src="./script.js"></script>


</body>

</html>