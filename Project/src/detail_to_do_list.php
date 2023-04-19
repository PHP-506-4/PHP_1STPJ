<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    define( "HEADER", SRC_ROOT."header_to_do_list.php");
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
    <!-- <link rel="stylesheet" href="공통css파일주소"> 파일 나중에 추가되면 활성화 시킬 예정 -->
</head>
<body>
    <?php include_once( HEADER ); ?>
    <div class="con">
        <p><?php echo $result_info["list_title"]; ?></p>
        <span><?php echo sprintf('%02d',$result_info["list_start_time"]); ?>:</span>
        <span><?php echo sprintf('%02d',$result_info["list_start_minute"]); ?>~</span>
        <span><?php echo sprintf('%02d',$result_info["list_end_time"]); ?>:</span>
        <span><?php echo sprintf('%02d',$result_info["list_end_minute"]); ?></span>
        <p><?php echo $result_info["list_memo"]; ?></p>
        <a href="update_to_do_list.php?list_no=<?php echo $result_info["list_no"];?>">수정</a>
        <a href="to_do_list.php">리스트로</a>
    </div>
</body>
</html>