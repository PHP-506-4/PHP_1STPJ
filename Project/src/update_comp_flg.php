<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
include_once( URL_DB );
$arr_get = $_GET;
$result_flg = select_list_no($arr_get["list_no"]);
$flg = $result_flg["list_comp_flg"];
if ($flg === '0')                                   // 수행 완료 아닐때 수행 완료 시켜주는 기능
{
    $arr = 
        array(
            "list_comp_flg" =>  '1'
            ,"list_no"      => $arr_get["list_no"]
        );
        update_comp_flg( $arr );
}
else                                                // 수행 완료 아닐때 수행 완료 시켜주는 기능
{
    $arr = 
        array(
            "list_comp_flg" =>  '0'
            ,"list_no"      => $arr_get["list_no"]
        );
    update_comp_flg( $arr );
}

header("Location: to_do_list.php");
exit();
?>