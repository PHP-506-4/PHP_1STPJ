<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER", SRC_ROOT."header_to_do_list.php" );
include_once( URL_DB );
$result = select_goal_info();
$rqt_mtd = $_SERVER["REQUEST_METHOD"];
if ($rqt_mtd === "POST")
{
    $result_post = $_POST;
    update_goal($result_post);
    header("Location:to_do_list.php");
    exit();
}
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
<?php include_once(URL_HEADER);?>
    <form action="goal_update.php" method="post">
        <label for="goal_title">목표</label>
        <input type="text" name="goal_title" id="goal_title" value="<?php echo $result["goal_title"]?>">
        <label for="goal_date">날짜</label>
        <input type="date" name="goal_date" id="goal_date" value="<?php echo $result["goal_date"]?>">
        <br>
        <button type="submit">수정</button>
        <button type="button"><a href="to_do_list.php">취소</a></button>
    </form>
</body>
</html>