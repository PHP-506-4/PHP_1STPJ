<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER", SRC_ROOT."header_to_do_list.php" );
define( "PROFILE", SRC_ROOT."profile_to_do_list.php" );
define( "FOOTER", SRC_ROOT."footer_to_do_list.php");

include_once( URL_DB );
$rqt_mtd = $_SERVER["REQUEST_METHOD"]; // POST 방식 OR GET 방식인지 체크

if ($rqt_mtd === "POST") {             // post 방식일때
    $arr_post = $_POST;
    update_goal($arr_post);                 // form 방식으로 받은 값 업데이트
    header("Location: to_do_list.php");     // 리스트 페이지로 이동후 종료
    exit();
}
else
{
    $result = select_goal_info();       // 목표 값을 불러 오기 위해 사용
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./common/goal_update.css">
</head>
<body>
    <div class="con">
        <?php include_once(URL_HEADER);?>
        <br>
        <?php include_once( PROFILE ) ?>
        <div class="con1">
            <h2>목표 수정</h2>
            <form action="goal_update.php" method="post">
                <label for="goal_title">목표</label>
                <input type="text" name="goal_title" id="goal_title" required value="<?php echo $result["goal_title"]?>" autofocus autocomplete="off" spellcheck="false">
                <br>
                <label for="goal_date">날짜</label>
                <input type="date" name="goal_date" id="goal_date" value="<?php echo $result["goal_date"]?>">
                <br>
                <div class="buttons">
                    <button type="submit">수정</button>     <!-- 수정 버튼 누를시 POST 로 저장 -->
                    <a href="to_do_list.php">취소</a>       <!-- 리스트 페이지 이동 -->
                </div>
            </form>
        </div>
    </div>
    <?php include_once ( FOOTER ); ?>
</body>
</html>