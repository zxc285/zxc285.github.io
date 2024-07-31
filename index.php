<!DOCTYPE html>

<?php
    include "connect.php";
    $lngwiki_sql = "SELECT * FROM vods ORDER BY date DESC";
    $result = mysqli_query($lngwiki_db, $lngwiki_sql);
    $rowcount = mysqli_num_rows($result);
    $i = 0;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LNG-wiki</title>
    <link rel="icon" href="https://yt3.googleusercontent.com/ytc/AIdro_kv_7s9xm0c-PgXHTPn4vq3hywtPyQRAtqLPS0j_a_0Xw=s176-c-k-c0x00ffffff-no-rj">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <div class="page">
    
    
        <div class="sidebar"> 
            <div class="title">LNG wiki</div> 
                <div class="navbar-nav">     
                    <div class="nav-item" >
                        <a class="nav-link" href="index.php">首頁</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="search3.php">搜尋關鍵字</a>
                    </div>
                    <div style="color: #6e6e6e; margin-top:20px">問題回報</div>
                </div>
            
        </div>
        <div class="marquee-container">
            <div class="marquee-content">
            下次開台時間：8/31
            </div>
        </div>
        
        <div class="main">
            <div class="info">
                <a href="https://www.youtube.com/@LNGworkshop" style="text-decoration: none;"><div class="YTinfo"><img src="https://yt3.googleusercontent.com/ytc/AIdro_kv_7s9xm0c-PgXHTPn4vq3hywtPyQRAtqLPS0j_a_0Xw=s160-c-k-c0x00ffffff-no-rj"  
                width="50"height="50" style="border-radius:50%;">LNG 實況存檔</div></a>
                <a href="https://www.youtube.com/@lng6121" style="text-decoration: none;"><div class="YTinfo"><img src="https://yt3.googleusercontent.com/ytc/AIdro_lfO6z6DatzQW5CkKsHy7gU4xd8Ysdsc9JrQgKmtjqcSQ=s160-c-k-c0x00ffffff-no-rj"
                width="50"height="50" style="border-radius:50%;">LNG 精華頻道</div></a>
            </div>
            
            
            
            <table class="table table-bordered">
                <thead align='center' valign="middle">
                    <tr>
                        <th>標題</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($rowcount > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result)) {
                                 
                                echo "<tr>";
                                echo "<td><a class='table-link' href='test.php?id=".$row['v_id']. "&searchText=" . urlencode($row['vname']) . "&action=sent" . "'>" . $row['vname'] . "</a></td>";
                                echo "<td><a class='table-link' href='" .'delete/delete2.php?id='.$row['v_id']. "'>" ."刪除"."</a></td>";
                                // echo "<td><a href='search4.php?id=".$row['v_id']. "&searchText=" . urlencode($row['vname']) . "&action=sent"."'>新增關鍵字</a></td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>

            </table>
            
        </div>

    </div>

    
    <script src="./script.js"></script>


</body>

</html>