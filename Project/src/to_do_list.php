<?php
define( "DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src" );
define( "URL",DB_CON."/common/db_common.php" );
define( "GOAL",DB_CON."/goal_to_do_list.php" );
define( "HEADER", DB_CON."/header_to_do_list.php" );
define( "PROFILE", DB_CON."/profile_to_do_list.php" );
define( "FOOTER", DB_CON."/footer_to_do_list.php");
include_once(URL);

if( array_key_exists( "page_num", $_GET ) )
{
    $page_num = $_GET["page_num"];
}
else
{
    $page_num = 1;
}

$limit_num = 7;

$result_cnt = select_list_all_cnt();

$max_page_num = ceil( (int)$result_cnt / $limit_num );

$offset = ( $page_num * $limit_num ) - $limit_num;

$arr_prepare =
    array(
        "limit_num"	=> $limit_num
        ,"offset"	=> $offset
    );

// 페이징용 데이터 검색
$result_paging = select_list_info( $arr_prepare );
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
    <link rel="stylesheet" href="./common/css_to_do_list.css">
    <style>
        .a{
            text-align: center;
        }
    </style>
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
                        <?php
                        foreach ($result_paging as $val)
                        {
                        ?>
                        <a href="detail_to_do_list.php?list_no=<?php echo $val["list_no"]?>">
                            <div class="list">
                                
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
                                
                                <div class="title"><?php echo $val["list_title"]?></div>
                                <div class="time">
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
                                </div>
                            </div>
                            </a>
                        <?php
                        }
                        ?>
                        <br>
                        <div class="a">
                        <?php
                            if ($page_num > 1)
                            {
                            ?>
                            <a href='to_do_list.php?page_num=<?php echo $page_num-1 ?>'class="page_button"><</a>
                            <?php
                            }
                            else
                            {
                            ?>
                                <a href='to_do_list.php?page_num=<?php echo $page_num ?>'class="page_button"><</a>
                            <?php
                            }
                            ?>
                            <?php
                                for( $i = 1; $i <= $max_page_num; $i++ )
                                {
                            ?>
                                    <a href='to_do_list.php?page_num=<?php echo $i ?>'class="page_button"><?php echo $i ?></a>
                            <?php
                                }
                            ?>
                            <?php
                            if ($page_num < $max_page_num )
                            {
                            ?>
                                <a href='to_do_list.php?page_num=<?php echo $page_num +1 ?>'class="page_button">></a>
                            <?php
                            }
                            else
                            {
                            ?>
                                <a href='to_do_list.php?page_num=<?php echo $page_num  ?>'class="page_button">></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once( FOOTER ); ?>
</body>
</html>