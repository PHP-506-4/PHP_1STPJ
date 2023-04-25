<?php
    define( "DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src" );
    define( "URL",DB_CON."/common/db_common.php" );
    define( "GOAL",DB_CON."/goal_to_do_list.php" );
    define( "HEADER", DB_CON."/header_to_do_list.php" );
    define( "PROFILE", DB_CON."/profile_to_do_list.php" );
    define( "FOOTER", DB_CON."/footer_to_do_list.php");
    
    include_once( URL );

$rqt_mtd = $_SERVER["REQUEST_METHOD"];

if ($rqt_mtd === "POST") {
    $arr_post = $_POST;
    update_profile_info( $arr_post );
    header("Location: to_do_list.php");
    exit();
}
else
{
    $result = select_profile_info();
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
    <link rel="stylesheet" href="./common/css_update_profile_info.css">
</head>
<body>
    <div class="con">
        <?php include_once( HEADER ); ?>
        <br>
        <?php include_once( PROFILE ) ?>
        <div class="con1">
            <h2>프로필 수정</h2>
            <form action="" method="post">
                <label for="profile_name">닉네임</label>
                <input class="name" type="text" name="profile_name" id="profile_name" value="<?php echo $result['profile_name'] ?>" maxlength="6" placeholder="닉네임">
                <br>
                <input type="file" accept="image/*" id="profile_img" name="profile_img" required ?>
                <div class="btn_con">
                    <button type="submit">수정</button>
                    <a href="to_do_list.php">취소</a>
                </div>
            </form>
        </div>
    </div>
    <?php include_once( FOOTER ); ?>
</body>
</html>
