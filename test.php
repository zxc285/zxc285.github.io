<!DOCTYPE html>
<?php
include "connect.php";
$i = 0;
$rowcount = 0;
$flag = 0;
$v_id = "";  // 用來儲存找到的 v_id
$vname = "";
$vurl="";
$hurl="";
$id = isset($_GET['id']) ? $_GET['id'] : '';
$newURL="";
$embed = "https://www.youtube.com/embed/";
$watch = "https://www.youtube.com/watch?v=";
$youtube="<iframe width='560' height='315' src='' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";
if (isset($_REQUEST['action'])) {

    if ($_REQUEST['action'] == 'sent') {
        $input_text = trim($_REQUEST['searchText']);
        if($input_text == ""){
            echo "<script>alert('Please input title');history.go(-1);</script>";
        }else{
            $flag = true;
        }
        $sql = "SELECT *
        FROM keyword
        JOIN vods ON keyword.v_id = vods.v_id
        WHERE vname LIKE '%".$input_text."%'
        ORDER BY timeline";
        $result = mysqli_query($lngwiki_db, $sql);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $row = mysqli_fetch_assoc($result);
            $v_id = $row['v_id'];  // 獲取 v_id
            $vname = $row['vname'];
            $vurl = $row['vURL'];
        } else {
            echo "";
        }
        // 新增查询获取 `unofficial_highlight` 表中的数据
        $unofficial_sql = "SELECT *
        FROM unofficial_highlight
        JOIN vods ON unofficial_highlight.v_id = vods.v_id
        WHERE vname LIKE '%".$input_text."%'";
        $unofficial_result = mysqli_query($lngwiki_db, $unofficial_sql);
        $unofficial_rowcount = mysqli_num_rows($unofficial_result);

        $official_sql = "SELECT *
        FROM official_highlight
        JOIN vods ON official_highlight.v_id = vods.v_id
        WHERE vname LIKE '%".$input_text."%'";
        $official_result = mysqli_query($lngwiki_db, $official_sql);
        $official_rowcount = mysqli_num_rows($official_result);
    }
}
?>
<!DOCTYPE html>
<?php
include "connect.php";
$i = 0;
$rowcount = 0;
$flag = 0;
$v_id = "";  // 用來儲存找到的 v_id
$vname = "";
$vurl="";
$hurl="";
$id = isset($_GET['id']) ? $_GET['id'] : '';
$newURL="";
$embed = "https://www.youtube.com/embed/";
$watch = "https://www.youtube.com/watch?v=";
$youtube="<iframe width='560' height='315' src='' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";
if (isset($_REQUEST['action'])) {

    if ($_REQUEST['action'] == 'sent') {
        $input_text = trim($_REQUEST['searchText']);
        if($input_text == ""){
            echo "<script>alert('Please input title');history.go(-1);</script>";
        }else{
            $flag = true;
        }
        $sql = "SELECT *
        FROM vods
        LEFT JOIN keyword ON vods.v_id = keyword.v_id
        WHERE vname LIKE '%".$input_text."%'
        ORDER BY timeline";
        $result = mysqli_query($lngwiki_db, $sql);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $row = mysqli_fetch_assoc($result);
            $v_id = $row['v_id'];  // 獲取 v_id
            $vname = $row['vname'];
            $vurl = $row['vURL'];
        } else {
            echo "";
        }
        // 新增查询获取 `unofficial_highlight` 表中的数据
        $unofficial_sql = "SELECT *
        FROM unofficial_highlight
        JOIN vods ON unofficial_highlight.v_id = vods.v_id
        WHERE vname LIKE '%".$input_text."%'";
        $unofficial_result = mysqli_query($lngwiki_db, $unofficial_sql);
        $unofficial_rowcount = mysqli_num_rows($unofficial_result);

        $official_sql = "SELECT *
        FROM official_highlight
        JOIN vods ON official_highlight.v_id = vods.v_id
        WHERE vname LIKE '%".$input_text."%'";
        $official_result = mysqli_query($lngwiki_db, $official_sql);
        $official_rowcount = mysqli_num_rows($official_result);
    }
}
?>

<html lang="en">

<head>
<meta charset="UTF-8">
    <title>LNG wiki</title>
    <script src="https://kit.fontawesome.com/2f49bb564c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="https://yt3.googleusercontent.com/ytc/AIdro_kv_7s9xm0c-PgXHTPn4vq3hywtPyQRAtqLPS0j_a_0Xw=s176-c-k-c0x00ffffff-no-rj">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css?v=<?=time()?>" type="text/css">
</head>

<body>
    <div class="page">
        <div class="sidebar">
            <div class="title">LNG wiki</div>
            <div class="navbar-nav">
                <div class="nav-item">
                    <a class="nav-link" href="index.php">首頁</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="search3.php">搜尋關鍵字</a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="right">
                <?php
                if ($flag) {
                    if ($rowcount > 0) {
                        $newURL = str_replace($watch, $embed, $vurl);
                        $youtube = "<iframe id='youtube-player' width='560' height='315' src='" . $newURL . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";
                        echo "<div class='video'>$vname $youtube</div>";
                    } else {
                        echo "<div class='video'>$vname</div>";
                    }
                }
                echo "<br>";
                ?>
                <div class="add">
                    <h2 onclick="toggleForm('formKW');">新增關鍵字</h2>
                    <form method="POST" action="add/addKW.php?id=<?php echo $id; ?>" style="display:none" id="formKW">
                        <label for="word">關鍵字:</label>
                        <input type="text" name="word" id="word" required>
                        <label for="hh">Time(h):</label>
                        <input type="number" name="hh" id="hh" value="0">
                        <label for="mm">Time(m):</label>
                        <input type="number" name="mm" id="mm" value="0">
                        <label for="ss">Time(s):</label>
                        <input type="number" name="ss" id="ss" value="0">
                        <input type="submit" value="新增" class="btn btn-primary">
                    </form>
                </div>
                <?php
                echo "<div class='keywordList'>";
                if ($rowcount > 0) {
                    mysqli_data_seek($result, 0); // 將指針移回結果集的第一行
                    while ($row = $result->fetch_assoc()) {
                        $time_arr[$i] = $row['timeline'];
                        $word_arr[$i] = $row['word'];
                        $del_arr[$i] = "<a class='table-link' href='delete/deleteKW.php?key_id=" . $row['key_id'] . "&vod_id=" . $id . "&searchText=" . urlencode($vname) . "'><i class='delete fa-solid fa-x'></i></a>";
                        echo "<span class='KW' data-timeline='" . $row['timeline'] . "'>$word_arr[$i] $del_arr[$i]</span>";
                        $i++;
                    }
                }
                echo "</div>";
                ?>
            </div>
            <div class="left">
                <div class="subtitle">官方精華</div>
                <?php
                if ($official_rowcount > 0) {
                    while ($row = $official_result->fetch_assoc()) {
                        $oUrl_arr[$i] = $row['oURL'];
                        $newOURL = str_replace($watch, $embed, $row['oURL']);
                        $youtube = "<iframe width='350' height='185' src='" . $newOURL . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";

                        echo "$youtube";
                    }
                }else{
                    echo "<h3 style='color:#747474'>目前無精華</h3>";
                }
                ?>
                <div class="subtitle">非官方精華</div>
                <br>
                <div class="add" style="align-items: center;">
                    <div class="addTitle" onclick="toggleForm('formHL');">新增精華</div>
                    <form method="POST" action="add/addHL.php?id=<?php echo $id; ?>" style="display:none; flex-direction: column;" id="formHL">
                        <label for="uName">精華標題:</label>
                        <input type="text" name="uName" id="uName" placeholder="">
                        <label for="uDate">上傳日期:</label>
                        <input type="date" name="uDate" id="uDate">
                        <label for="creator">作者:</label>
                        <input type="text" name="creator" id="creator">
                        <label for="URL">網址:</label>
                        <input type="text" name="URL" id="URL" required>
                        <input type="submit" value="新增" class="btn btn-primary">
                    </form>
                </div>
                <?php
                    if ($unofficial_rowcount > 0) {
                        while ($row = $unofficial_result->fetch_assoc()) {
                            $hurl_arr[$i] = $row['URL'];
                            $newURL = str_replace($watch, $embed, $row['URL']);
                            $creator_arr[$i] = $row['creator'];
                            $youtube = "<iframe width='350' height='185' src='" . $newURL . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";
                            $del_arr[$i] = "<a class='table-link' href='delete/deleteHL.php?uid=" . $row['id'] . "&vod_id=" . $id . "&searchText=" . urlencode($vname) . "'>" . "刪除" . "</a>";
                            echo "<div class='s' style='color: #f0f0f0;'>".
                                    "<span class='creator'>".$creator_arr[$i]."</span>". "<span class='creator-del'>".$del_arr[$i]."</span>".
                                "</div>";
                            echo $youtube."<br>";
                            $i++;
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>

</html>
