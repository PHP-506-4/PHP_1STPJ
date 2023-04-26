<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
include_once( URL_DB );
$arr_get = $_GET;   // GET Request Parameter 획득
$result_flg = select_list_no($arr_get["list_no"]);  // GET 에서 받은 정보(list_no)로 DB에서 리스트 상세 정보 획득
$flg = $result_flg["list_comp_flg"];                // 수행완료 여부 확인하기 위해 리스트 상세 정보 중 "list_comp_flg"를 가져온다
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

header("Location: to_do_list.php");                 // 위의 기능 수행 후 리스트 페이지로 돌아간다
exit();
?>