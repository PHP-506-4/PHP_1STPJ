<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    define( "HEADER", SRC_ROOT."header_to_do_list.php");
    define( "PROFILE", SRC_ROOT."profile_to_do_list.php" );
    define( "FOOTER", SRC_ROOT."footer_to_do_list.php");
    include_once ( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];                                                                                              // form을 GET 인지 POST인지 체크
    if( $http_method === "POST")                                                                                                            // POST 방식 일때
    {
        $arr_post = $_POST;

        $result_cnt = insert_to_do_list_info( $arr_post );                                                                                  // POST로 받아온 값 DB 추가 및 확인하는 함수

        $arr_no = select_to_do_list_limit();                                                                                                // 상세 페이지 이동을 위한 list_no 값 가져오기 위해 함수 사용
        

        header( "Location: detail_to_do_list.php?list_no=".$arr_no["list_no"] );                                                            // location에 적힌 페이지 이동 및 종료
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
    <div class="con">
        <?php include_once( HEADER ); ?>                                                                                                    <!-- 이미지파일 출력 -->
        <br>
        <?php include_once( PROFILE ) ?>                                                                                                    <!-- 프로필 출력 -->
        <div class="con1">
            <!-- insert 페이지 -->
            <h2>리스트 작성</h2>
            <form method="post" action="insert_to_do_list.php">                                                                             <!-- input 값을 POST방식으로 전달 -->
                <!-- 게시글 번호(히든), 게시글 제목 -->
                <!-- <input type="hidden" name="list_no" class="list_no">       0427 list_no 필요없어서 삭제 -->
                <input type="text" name="list_title" class="list_title" placeholder="제목" required autofocus autocomplete="off" spellcheck="false">
                <br>
                <div class="con2">
                    <div class=con_start_time>
                        <!-- 시작 시간과 분 -->
                        <span>시작 시간</span>
                        <input type="number" name="list_start_time" class="list_start_time" id="list_start_time" min="0" max="23"> :
                        <input type="number" name="list_start_minute" class="list_start_minute" id="list_start_minute" min="0" max="59">
                    </div>
                    <div class=con_end_time>
                        <!-- 종료 시간과 분 -->
                        <span>종료 시간</span>
                        <input type="number" name="list_end_time" class="list_end_time" id="list_end_time" min="0" max="23"> :
                        <input type="number" name="list_end_minute" class="list_end_minute" id="list_end_minute" min="0" max="59">
                    </div>
                </div>
                <!-- 리스트 메모 -->
                <textarea name="list_memo" class="list_memo" placeholder="메모" spellcheck="false"></textarea>
                <br>
                <div class="con_btn">
                <!-- 추가, 취소 버튼 -->
                    <button type="submit" class="button_1">추가</button>                                                                        <!-- form 값 전송 버튼 -->
                    <button type="button" class="button_2" onclick="location.href='to_do_list.php'">취소</button>
                </div>
            </form>
        </div>
    </div>
    <?php include_once ( FOOTER ); ?>
</body>
</html>