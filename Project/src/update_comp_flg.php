<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
include_once( URL_DB );
$arr_get = $_GET;
update_comp_flg( $arr_get );
header("Location: to_do_list.php");
exit();
?>