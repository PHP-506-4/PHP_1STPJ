<?php
define("DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src");                          
define("URL",DB_CON."/common/db_common.php");
define( "URL_HEADER", DB_CON."/header_to_do_list.php" );
define( "PROFILE", DB_CON."/profile_to_do_list.php" );
define( "FOOTER", DB_CON."/footer_to_do_list.php");
include_once(URL);

$list_no = $_GET["list_no"];                            

$result_title = select_list_no( $list_no );                             /* get으로 받은 list_no를 조회 */

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="연결할 CSS파일 경로">
    <title>삭제 페이지</title>
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./delete.css">
</head>
<body>
    <div class="con">
        <?php include_once(URL_HEADER);?>                                                               <!-- 헤더부분 연결 -->
        <br>
        <?php include_once( PROFILE ) ?>                                                                <!-- 프로필부분 연결 -->
        <div class="con1">
            <h2>리스트 삭제</h2>
            <p class="title_p"><?php echo $result_title["list_title"] ?></p>                                                          <!-- GET으로 넘어오는 값을 받아서 해당 list_no의 list_title을 화면에 표시 -->
            <p class="exception_p">이 리스트를 삭제합니다.<br>동의 하시면 확인을 눌러 주세요.</p>                     <!-- 주의 메세지 -->
                <a class="check" href=" sub_delete.php?list_no=<?php echo $list_no ?>" >
                    확인                                                                <!-- sub_delete.php로 가서 삭제하고 to_do_list로 이동 -->
                </a>
            <a class="cancel" href="detail_to_do_list.php?list_no=<?php echo $list_no ?>" >
                    취소                                                                <!-- 클릭시 상세 페이지로 이동 -->
                </a>
        </div>
    </div>
    <?php include_once( FOOTER ); ?>                                                    <!-- footer부분 include_once로 연결 -->
</body>
</html>