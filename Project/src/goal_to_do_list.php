<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    include_once( URL_DB );
    $result = select_goal_info();
    $goal_date = "";
    $g_title = "";

    if ( empty($result["goal_title"]) ) {
        $g_title = "목표를 정해주세요";
        $d_day ="";
    }
    else {
        $g_title = $result["goal_title"];
        $goal_date = $result["goal_date"];
        $d_day = floor((strtotime($goal_date) - strtotime(date('y-m-d'))) / 86400 );
        $d_day = intval($d_day);
    }

    $percent = comp_percent();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .graph{
            width: 300px;
            background-color: rgb(224, 224, 224);
            height: 15px;
            font-size: 0;
            border-radius: 10px;
            overflow: hidden;
            display: inline-block;
        }
        .per{
            width: 1%;
            height: 15px;
            background-color: rgb(59, 230, 87);
            display: inline-block;
        }
    </style> -->
</head>
<body>
    <div class="g_con">
        <?php
            $result_d = "";
            if ( $d_day === 0 )
            {
                $result_d = "D-DAY";
                ?>
                <span class=d_day><?php echo $g_title?></span>
                <span class="bar"> | </span>
                <span class=d_day><?php echo $result_d?></span>
        <?php }
            else if( $d_day === 1 )
            {
                $result_d = "D-".$d_day;
                ?>
            <span class=d_day><?php echo $g_title?></span>
            <span class="bar"> | </span>
            <span class=d_day><?php echo $result_d?></span>
            <?php
            }
            else if( $d_day > 0 )
            {
                $result_d = "D-".$d_day;
                ?>
                <span><?php echo $g_title?></span>
                <span class="bar"> | </span>
                <span><?php echo $result_d?></span>
                <?php
            }
            else if(empty($result["goal_title"]))
            {
                ?>
                <span><?php echo $g_title?></span>
        
                <?php
            }
            else
            {
                $result_d = substr( $goal_date, 5 );?>
            <span class=d_past><?php echo $g_title?></span>
            <span class="bar"> | </span>
            <span class=d_past><?php echo $result_d?></span>
        <?php
            }?>
    <a class="edit_btn" href="goal_update.php">EDIT</a>
</div>
    <br>
    <div class="comp_graph">
        <span>달성도 <?php echo $percent ?>%</span>
        <div class=graph>
            <?php for ($i=0; $i <= $percent ; $i++)
            { ?>
                <div class=per></div>
            <?php
            }?>
        </div>
    </div>
    <a class="add_btn" href="insert_to_do_list.php">리스트추가</a>
</body>
</html>