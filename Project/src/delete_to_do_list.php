<?php
define("DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src");                           /* 정확한 파일의 루트가 정해지면 수정 */
define("URL",DB_CON."/common/db_common.php");
define( "URL_HEADER", DB_CON."/header_to_do_list.php" );
define( "PROFILE", DB_CON."/profile_to_do_list.php" );
include_once(URL);

$list_no = $_GET["list_no"];

$result_title = select_list_no( $list_no );

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="연결할 CSS파일 경로">                          <!-- CSS파일이 정해지면 경로 수정 -->
    <title>삭제 페이지</title>
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./delete.css">
</head>
<body>
<div class="main">
    <div class="con">
        <?php include_once(URL_HEADER);?>                                                     <!-- 헤더 영역이 정해지면 include_once로 설정  -->
        <br>
        <?php include_once( PROFILE ) ?>
        <h2>리스트 삭제</h2>
        <div class="con1">
            <p class="title_p">제목 : <?php echo $result_title["list_title"] ?></p>                                                          <!-- PK로 넘어오는 값을 받아서 해당 PK의 제목을 화면에 표시 -->
            <p class="exception_p">정보를 완전히 삭제합니다.<br>동의 하시면 확인을 눌러 주세요.</p>                     <!-- 주의 메세지 -->
            <button type="button">
                <a href=" sub_delete.php?list_no=<?php echo $list_no ?>" >
                    확인                                                                <!-- 클릭시 삭제를 완료하고 리스트 페이지로 이동(삭제 페이지를 하나 더 만들어야 된다.) -->
                </a>                                                                    <!-- 그 페이지로 넘어가서 삭제를 하고 리스트 페이지로 바로 넘어갈 수 있게 만들어야 된다. -->
            </button>
            <button type="button">
            <a href="detail_to_do_list.php?list_no=<?php echo $list_no ?>" >
                    취소                                                                <!-- 클릭시 상세 페이지로 이동(상세 페이지의 URL을 작성) -->
                </a>
            </button>
        </div>
    </div>
</div>
</body>
</html>