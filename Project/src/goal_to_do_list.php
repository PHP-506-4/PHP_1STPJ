<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    include_once( URL_DB );
    $result = select_goal_info();
    $goal_date = "";
    $g_title = "";

    if ( empty($result["goal_title"]) ) {                                              // 목표가 초깃값일때 출력할 내용
        $g_title = "공부 목표를 정해주세요";
        $d_day ="";
    }
    else {
        $g_title = $result["goal_title"];                   // 목표가 초깃값이 아닐 때 제목과 D-DAY 혹은 날짜 출력
        $goal_date = $result["goal_date"];
        $d_day = (strtotime($goal_date) - strtotime(date('y-m-d'))) / 86400 ;    // D-DAY 계산
        $d_day = intval($d_day); // 속성변환을 하지 않으면 일어날 수 있는 에러 방지하기 위해서 intval 사용
    }

    $percent = comp_percent();              // 달성도 계산
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="g_con">
        <?php                           // D-DAY 구하는 부분
            $result_d = "";
            if ( $d_day === 0 )                                 // D-DAY 일때 D-DAY 출력 + 하이라이트
            {
                $result_d = "D-DAY";
                ?>
                <span class=d_day><?php echo $g_title?></span>
                <span class="bar"> | </span>
                <span class=d_day><?php echo $result_d?></span>
        <?php }
            else if( $d_day === 1 )                                 // D-DAY 일때 D-1 출력 + 하이라이트
            {
                $result_d = "D-".$d_day;
                ?>
            <span class=d_day><?php echo $g_title?></span>
            <span class="bar"> | </span>
            <span class=d_day><?php echo $result_d?></span>
            <?php
            }
            else if( $d_day > 1 )                                   // D-DAY 1일 이상일때 D-남은 날짜 출력
            {
                $result_d = "D-".$d_day;
                ?>
                <span><?php echo $g_title?></span>
                <span class="bar"> | </span>
                <span><?php echo $result_d?></span>
                <?php
            }
            else if(empty($result["goal_title"]))                   // 초깃값일때 D-DAY 출력 안 하고 초기 메세지 출력
            {
                ?>
                <span><?php echo $g_title?></span>
        
                <?php
            }
            else                                                   // D-DAY 지났을 때 월-일만 출력
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
            <?php for ($i=0; $i <= $percent ; $i++)     // 달성도만큼 그래프 그리는 부분
            { ?>
                <div class=per></div>
            <?php
            }?>
        </div>
    </div>
    <a class="add_btn" href="insert_to_do_list.php">리스트추가</a>
</body>
</html>