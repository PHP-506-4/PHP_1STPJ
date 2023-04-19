<?php 
define("DB_CON",$_SERVER["DOCUMENT_ROOT"]."/Project/src");                           
define("URL",DB_CON."/common/db_common.php");
include_once(URL);
$result_get = $_GET;
delete_list($result_get);
header("Location: to_do_list.php");
exit;
?>