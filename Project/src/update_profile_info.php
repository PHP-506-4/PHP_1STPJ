<?php
    define( "DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src" );
    define( "URL",DB_CON."/common/db_common.php" );
    define( "GOAL",DB_CON."/goal_to_do_list.php" );
    define( "HEADER", DB_CON."/header_to_do_list.php" );
    define( "PROFILE", DB_CON."/profile_to_do_list.php" );
    define( "FOOTER", DB_CON."/footer_to_do_list.php");
    
    include_once( URL );

$rqt_mtd = $_SERVER["REQUEST_METHOD"];      // $_SERVER["REQUEST_METHOD"] 사용해서 데이터 post로 받아왔는지 확인

if ($rqt_mtd === "POST")
{                  // post 형식으로 값이 넘어왔을때
    $arr = 
        array(
            "profile_name"  =>  $_POST['profile_name']
            ,"profile_img"  =>  $_FILES['profile_img']['name']
            );
    $temp_f = $_FILES['profile_img']['tmp_name'];
    $dir_f = "./img/".$_FILES['profile_img']['name'];
    update_profile_info( $arr );
    move_uploaded_file($temp_f, $dir_f);

    header("Location: to_do_list.php");
    exit();
}
else
{
    $result = select_profile_info();        // 값이 post형식으로 넘어가지 않으면 프로필 정보 출력하기 위해서 함수 사용
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
            <form action="" method="post" enctype="multipart/form-data">
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
