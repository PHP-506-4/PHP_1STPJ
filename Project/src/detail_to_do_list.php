<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    define( "HEADER", SRC_ROOT."header_to_do_list.php");
    define( "PROFILE", SRC_ROOT."profile_to_do_list.php" );
    define( "FOOTER", SRC_ROOT."footer_to_do_list.php");
    include_once( URL_DB );

    $arr_get = $_GET; // GET Request Parameter 획득

    $result_info = ( select_list_no($arr_get["list_no"]) ); // DB에서 리스트 상세 정보 획득

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트 상세 페이지</title>
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./common/css_detail.css">
<body>
        <div class="con">
            <!-- 헤더 -->
            <?php include_once( HEADER ); ?>
            <br>
            <!-- 프로필 -->
            <?php include_once( PROFILE ) ?>
            <div class="con1">
                <h2>리스트 상세</h2>
                <div class="list_d1">
                    <!-- 리스트 제목 출력 -->
                    <p><?php echo $result_info["list_title"]; ?></p>
                </div>
                <!-- 공부 시작, 끝 시간 출력 -->
                <span>공부 시간</span>
                <div class="list_d2">
                    <span><?php echo sprintf('%02d',$result_info["list_start_time"]); ?> : </span>
                    <span><?php echo sprintf('%02d',$result_info["list_start_minute"]); ?> ~ </span>
                    <span><?php echo sprintf('%02d',$result_info["list_end_time"]); ?> : </span>
                    <span><?php echo sprintf('%02d',$result_info["list_end_minute"]); ?></span>
                </div>
                <!-- 메모 출력 -->
                <div class="list_d3">
                    <p><?php echo $result_info["list_memo"]; ?></p>
                </div>
                <!-- 수행완료 / 취소 버튼 -->
                <div class="con_btn">
                    <?php
                    $comp_flg = $result_info["list_comp_flg"];
                    if ( $comp_flg === '0' )
                    {?>
                        <a href="update_comp_flg.php?list_no=<?php echo $result_info["list_no"];?>" class="btn_chk">수행완료</a> <!-- 수행완료 아닐땐 수행완료 버튼 -->
                        <?php
                    }
                    else
                    {?>
                        <a href="update_comp_flg.php?list_no=<?php echo $result_info["list_no"];?>" class="btn_chk">수행취소</a> <!-- 수행완료 일땐 수행취소 버튼 -->
                    
                    <?php
                    }
                    ?>
                    <a href="update_to_do_list.php?list_no=<?php echo $result_info["list_no"];?>" class="btn1">수정</a>
                    <a href="to_do_list.php" class="btn2">리스트로</a>
                </div>
            </div>
        </div>
        <!-- 푸터 -->
    <?php include_once( FOOTER ); ?>
</body>
</html>