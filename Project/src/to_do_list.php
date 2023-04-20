<?php
define( "DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src" );
define( "URL",DB_CON."/common/db_common.php" );
define( "GOAL",DB_CON."/goal_to_do_list.php" );
define( "HEADER", DB_CON."/header_to_do_list.php" );
define( "PROFILE", DB_CON."/profile_to_do_list.php" );
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
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./common/css_goal_to_do_list.css">
</head>
<body>
    <div class="main">
        <div class="con">
            <?php include_once( HEADER ); ?>
            <br>
            <?php include_once( PROFILE ) ?>
            <div class="con1">
                <?php include_once( GOAL )?>
                <div class="clr">
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
                                    <img src="./img/check.png" alt="체크 안함">
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <img src="./img/checked.png" alt="체크 함">
                                <?php
                                }
                                ?>
                                </td>
                                <td>
                                <a href="detail_to_do_list.php?list_no=<?php echo $val["list_no"]?>"><?php echo $val["list_title"]?></a>
                                </td>
                                <td>
                                <?php
                                if($val["list_start_time"]!== "" && $val["list_start_minute"]!== "")
                                {
                                echo sprintf("%02d",$val["list_start_minute"])." : ".sprintf("%02d",$val["list_start_minute"]);
                                ?>
                                <span> ~ </span>
                                <?php
                                }
                                ?>
                                <?php
                                if($val["list_end_time"]!== "" && $val["list_end_minute"]!== "")
                                {
                                echo sprintf("%02d",$val["list_end_time"])." : ".sprintf("%02d",$val["list_end_minute"]);
                                }
                                ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>