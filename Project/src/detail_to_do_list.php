<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    include_once( URL_DB );

    $arr_get = $_GET; // GET Request Parameter 획득

    $result_info = ( select_list($arr_get["list_no"]) ); // DB에서 리스트 상세 정보 획득

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트 상세 페이지</title>
    <!-- <link rel="stylesheet" href="공통css파일주소"> 파일 나중에 추가되면 활성화 시킬 예정 -->
</head>
<body>
    <div class="con">
        <p><?php echo $result_info["list_title"]; ?></p>
        <p><?php echo $result_info["list_start_time"]; ?>:</p>
        <p><?php echo $result_info["list_start_minute"]; ?>~</p>
        <p><?php echo $result_info["list_end_time"]; ?>:</p>
        <p><?php echo $result_info["list_end_minute"]; ?></p>
        <p><?php echo $result_info["list_memo"]; ?></p>
        <a href="수정페이지?list_no=".<?php echo $result_info["list_no"]; ?>>수정</a>
        <a href="리스트페이지">리스트로</a>
    </div>
</body>
</html>