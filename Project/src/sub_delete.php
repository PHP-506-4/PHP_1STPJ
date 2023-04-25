<?php 
define("DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src");                           
define("URL",DB_CON."/common/db_common.php");
include_once(URL);
$result_get = $_GET;                                /* delete_list에서 get으로받은것을 $result_get에 담아줍니다.  */
delete_list($result_get);                           /* delete_list함수에 $result_get에 있는 페이지 넘버를 넣어서  */
header("Location: to_do_list.php");                 /* 완료후 리스트 페이지로 이동 합니다. */
exit();                                             /* 아래에 코드를 실행하지않게 해줍니다. */
?>