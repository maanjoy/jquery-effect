<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        img {
            width: 300px;
            display: inline-block;
            margin-right: 10px
        }
    </style>
</head>
<body>
<div class="main">
    <form>
        <div class="clear"></div>
        <div class="table">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td width="50">id</td>
                    <td>标题</td>
                    <td>内容</td>
                    <td width="30%">图片</td>
                    <td>日期</td>
                </tr>
                <?php
                require 'conn.php';
                $num = 2;
                $rs = mysqli_query($conn, "select * from article");

                $total = mysqli_num_rows($rs);
                echo '总数：' . $total;
                if (!$_GET['page']) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $start = ($page - 1) * $num;
                $sql = "select * from article limit $start,$num";
                $rs2 = mysqli_query($conn, $sql);
                $pages = ceil($total / $num);

                while ($list = mysqli_fetch_array($rs2, MYSQLI_NUM)) {
                    echo <<<EOT
<tr>
<td>$list[0]</td>
<td>$list[1]</td>
<td>$list[2]</td>
<td><img src='$list[3]'></td>
<td>$list[4]</td>

</tr>
EOT;
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
        <div class="clear"></div>

        <div class="right">
            <div class="page">
                <a href='pic.php?page=1'>首页</a>
                <?php
                if ($page >= 2) {
                    ?>
                    <a href='?page=<?php echo $page - 1; ?>'>上一页</a>
                    <?php
                }
                if ($page < $total) {
                    ?>
                    <a href='?page=<?php echo $page + 1; ?>'>下一页</a>
                    <?php
                }
                ?>
                <a href='?page=<?php echo $pages; ?>'>尾页</a>
                <!--         <a class="prev-off" href="#">&lt; Prev</a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a class="active" href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">7</a>
                        <a href="#">8</a>
                        <a href="#">9</a>
                        <a href="#">10</a>
                        <a class="next" href="#">Next &gt;</a> -->
            </div>
        </div>

        <div class="clear"></div>
    </form>
</div>
<script src="js/jquery.js"></script>
</body>
</html>