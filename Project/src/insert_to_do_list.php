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
</head>
<body>
    <div class="main">
        <div class="con">
            <?php include_once( HEADER ); ?>
            <br>
            <?php include_once( PROFILE ) ?>
            <div class="con1">
                <form method="post" action="insert_to_do_list.php">
                    <input type="hidden" name="list_no" class="list_no">
                    <input type="text" name="list_title" class="list_title" required>
                    <br>
                    <label for="list_start_time">시작시간</label>
                    <input type="number" name="list_start_time" class="list_start_time" id="list_start_time" min="0" max="23">:
                    <input type="number" name="list_start_minute" class="list_start_minute" id="list_start_minute" min="0" max="59">
                    <br>
                    <label for="list_end_time">종료시간</label>
                    <input type="number" name="list_end_time" class="list_end_time" id="list_end_time" min="0" max="23">:
                    <input type="number" name="list_end_minute" class="list_end_minute" id="list_end_minute" min="0" max="59">
                    <br>
                    <input type="text" name="list_memo" class="list_memo">
                    <br>
                    <button type="submit">추가</button>
                    <button type="button" onclick="location.href='to_do_list.php'">취소</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>