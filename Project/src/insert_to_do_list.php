<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    define( "HEADER", SRC_ROOT."header_to_do_list.php");
    define( "PROFILE", SRC_ROOT."profile_to_do_list.php" );
    include_once ( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];
    if( $http_method === "POST")
    {
        $arr_post = $_POST;

        $result_cnt = insert_to_do_list_info( $arr_post );

        $arr_no = select_to_do_list_limit();
        

        header( "Location: detail_to_do_list.php?list_no=".$arr_no["list_no"] );
        exit();
    }

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>작성 페이지</title>
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./insert_to_do_list.css">
</head>
<body>
    <div class="main">
        <div class="con">
            <?php include_once( HEADER ); ?>
            <br>
            <?php include_once( PROFILE ) ?>
            <div class="con1">
                <p>리스트 작성</p>
                <form method="post" action="insert_to_do_list.php">
                    <input type="hidden" name="list_no" class="list_no">
                    <input type="text" name="list_title" class="list_title" required>
                    <br>
                    <div class="con2">
                        <div class=con_start_time>
                            <span>시작 시간</span>
                            <input type="number" name="list_start_time" class="list_start_time" id="list_start_time" min="0" max="23"> :
                            <input type="number" name="list_start_minute" class="list_start_minute" id="list_start_minute" min="0" max="59">
                        </div>
                        <div class=con_end_time>
                            <span>종료 시간</span>
                            <input type="number" name="list_end_time" class="list_end_time" id="list_end_time" min="0" max="23"> :
                            <input type="number" name="list_end_minute" class="list_end_minute" id="list_end_minute" min="0" max="59">
                        </div>
                    </div>
                    <textarea name="list_memo" class="list_memo"></textarea>
                    <br>
                    <div class="con_btn">
                    <button type="submit" class="button_1">추가</button>
                    <button type="button" class="button_2" onclick="location.href='to_do_list.php'">취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>