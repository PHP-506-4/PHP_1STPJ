<?php
define("DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src");
define("URL",DB_CON."/common/db_common.php");
include_once(URL);

$result_goal_info = select_goal_info();
$result_list_info = select_list_info();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>to do list</title>
</head>
<body>
    <p><?php echo $result_goal_info["goal_title"]?></p>
    <table>
        <?php
        foreach ($result_list_info as $val)
        {
        ?>
            <tr>
                <td>
                <?php $val["list_no"]?>
                </td>
                <td>
                <?php
                $comp_flg = $val["list_comp_flg"];
                if($comp_flg === '0' )
                {
                    ?>
                    <img src="" alt="">
                <?php
                }
                else
                {
                    ?>
                    <img src="" alt="">
                <?php
                }
                ?>
                </td>
                <td>
                <a href="detail_to_do_list.php?list_no=<?php echo $val["list_no"]?>"><?php echo $val["list_title"]?></a>
                </td>
                <td>
                <?php
                if($val["list_start_time"]!== null && $val["list_start_minute"]!== null)
                {
                echo $val["list_start_time"]." : ".$val["list_start_minute"];
                }
                ?>
                </td>
                <td>
                <?php
                if($val["list_end_time"]!== null && $val["list_end_minute"]!== null)
                {
                echo $val["list_end_minute"]." : ".$val["list_end_minute"];
                }
                ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>