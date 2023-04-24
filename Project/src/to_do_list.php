<?php
define( "DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src" );
define( "URL",DB_CON."/common/db_common.php" );
define( "GOAL",DB_CON."/goal_to_do_list.php" );
define( "HEADER", DB_CON."/header_to_do_list.php" );
define( "PROFILE", DB_CON."/profile_to_do_list.php" );
define( "FOOTER", DB_CON."/footer_to_do_list.php");
include_once(URL);

if( array_key_exists( "page_num", $_GET ) )               /* $_GET에 "page_num"이 있을때 아래 조건을 실행한다. */
{
    $page_num = $_GET["page_num"];                        /* $page_num에 $_GET에 들어있는 배열 중에서 키값이"pagd_num"인 벨류 값을 저장한다. */
}
else                                                      /* 위에 if문 조건이 안맞을 경우 아래 조건을 실행한다. */
{
    $page_num = 1;                                        /* $page_num에 1이라는 값을 지정한다. */
}

$limit_num = 7;                                           /* $limit_num에 7이라는 값을 저장한다.(페이지에 표시할 최대 개수) */

$result_cnt = select_list_all_cnt();                      /* $result_cnt에 DB에서 레코드의 개수를 함수(select_list_all_cnt())를 이용해서 구하고 저장한다. */

$max_page_num = ceil( (int)$result_cnt / $limit_num );    /* 최대 레코드 수($result_cnt)를 인트로 변환한 후 페이지에 표시할 레코드 개수($limit_num)를 나누어서 올림한것을 $max_page_num에 저장한다.  */

$offset = ( $page_num * $limit_num ) - $limit_num;   /* 몇번째 부터 레코드를 표시할것인지 구한다. */

$arr_prepare =                                       /* 쿼리에 요청할 조건을 넣는 어레이 */
    array(
        "limit_num"	=> $limit_num
        ,"offset"	=> $offset
    );

// 페이징용 데이터 검색
$result_paging = select_list_info( $arr_prepare ); /* 쿼리에 어레이를 요청을 해서 $result_paging에 저장한다. */
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>to do list</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./img/fvc2.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
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
    <div class="con">
        <?php include_once( HEADER ); ?>
        <br>
        <?php include_once( PROFILE ) ?>
        <div class="con1">
            <?php include_once( GOAL )?>
            <div class="clr">                                 <!-- con1의 float 속성 해제하는 용 -->
                <?php
                foreach ($result_paging as $val)          /* $result_paging에 있는 어레이 수 만큼 $val와 같이 반복된다. */
                {
                ?>
                    <a href="detail_to_do_list.php?list_no=<?php echo $val["list_no"]?>">   <!-- 리스트를 클릭하면 해당 리시트의 상세 페에지로 이동 -->
                        <div class="list">
                            <?php                                                       /* ----------------------foreach에서 돌아가는 if문------------------ */
                            $comp_flg = $val["list_comp_flg"];                          /* 완료플레그를 $comp_flg에 저장한다 */
                            if($comp_flg === '0' )                                      /* 만약 $comp_flg에 '0'이 들어있으면 아래조건(체크 안한 이미지를 입력)을 실행한다. */
                            {
                            ?>
                                <img src="./img/check.png" alt="체크 안함">
                            <?php
                            }
                            else                                                        /*$comp_flg에 '0'이 아닐경우 아래조건(체크한 이미지를 입력)을 실행한다. */
                            {
                            ?>
                                <img src="./img/checked.png" alt="체크 함">
                            <?php
                            }                                                           /* -------------------------------------------------- */
                            ?>                                                          
                            
                            <div class="title"><?php echo $val["list_title"]?></div>        <!-- 제목출력 -->
                            <div class="time">                                                                                      
                                <?php                                                                                                   /* -----------------시간 표시여부를 정하는 if문------------- */
                                if($val["list_start_time"]!== "" && $val["list_start_minute"]!== "")                                    /* $val["list_start_time"], $val["list_start_minute"]에 들어있는 값이 빈문자열이면 아래 조건을 표시 */
                                {
                                    echo sprintf("%02d",$val["list_start_time"])." : ".sprintf("%02d",$val["list_start_minute"]);           /* 시간과 분이 한자리수 일 때 앞에 0을 붙여서 출력한다. */
                                ?>
                                    <span> ~ </span>
                                <?php
                                }
                                ?>
                                <?php
                                if($val["list_end_time"]!== "" && $val["list_end_minute"]!== "")                                        /* $val["list_end_time"], $val["list_end_minute"]에 들어있는 값이 빈문자열이면 아래 조건을 표시 */
                                {
                                    echo sprintf("%02d",$val["list_end_time"])." : ".sprintf("%02d",$val["list_end_minute"]);               /* 시간과 분이 한자리수 일 때 앞에 0을 붙여서 출력한다. */
                                }                                                                                                       /* ------------------------------------------------------- */
                                ?>                                                                                                      
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
                <br>
                <div class="a">
                    <?php                                                                                                           /*--------------------- 페이지 이동 방법 -----------------*/
                    if ($page_num > 1)                                                                                          /* 현재페이지가 1보다 클때 아래조건을 실행한다. */
                    {
                    ?>
                        <a href='to_do_list.php?page_num=<?php echo $page_num-1 ?>'class="page_button"><</a>                        <!-- "  <  "을 누르면 현재페이지번호에서 1을 뺀 페이지로 이동한다. -->
                    <?php
                    }
                    else                                                                                                        /* 현재 페이지가 1보다 크지않을때는 아래 조건을 실행한다. */
                    {
                    ?>
                        <a href='to_do_list.php?page_num=<?php echo $page_num ?>'class="page_button"><</a>                      <!-- "  <  "를 눌러도 현재페이지에 머무른다. -->
                    <?php
                    }
                    ?>
                    <?php
                    for( $i = 1; $i <= $max_page_num; $i++ )                                                                 /* 1부터 위(23행)에서 구한 $max_page_num의 수만큼 for문을 돌린다. */
                    {
                    ?>
                        <a href='to_do_list.php?page_num=<?php echo $i ?>'class="page_button"><?php echo $i ?></a>          <!-- 포문이 돌아가면서 1부터 $max_page_num의 수까지 페이지 이동 버튼을 만든다. -->
                    <?php
                    }
                    ?>
                    <?php
                    if ($page_num < $max_page_num )                                                                             /* $page_num이 $max_page_num보다 작을때는 아래조건을 실행한다. */
                    {
                    ?>
                        <a href='to_do_list.php?page_num=<?php echo $page_num +1 ?>'class="page_button">></a>                   <!-- "  >  "을 누르면 현재페이지번호에서 1을 더한 페이지로 이동한다. -->
                    <?php
                    }
                    else                                                                                                         /* $page_num이 $max_page_num보다 작지않을때에는 아래조건을 실행한다. */
                    {
                    ?>
                        <a href='to_do_list.php?page_num=<?php echo $page_num  ?>'class="page_button">></a>                     <!-- "  >  "을 눌러도 현재페이지에 머무른다. -->
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once( FOOTER ); ?>
</body>
</html>