<?php
    //---------------------------------
    //함수명    : db_conn
    //기능      : php를 db에 연결
    //파라미터  : array(속성)   $param_conn(파라미터 명)
    //---------------------------------

    function db_conn( &$param_conn )
    {
        $host = "localhost";
        $user = "root";
        $pass = "root506";
        $charset = "utf8mb4";
        $db_name = "to_do_list";
        $dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
        $pdo_option =
            array(
                PDO::ATTR_EMULATE_PREPARES      => false
                ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
                ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
            );

        try
        {
            $param_conn = new PDO( $dns, $user, $pass, $pdo_option );
        }
        catch (Exception $e)
        {
            $param_conn = null;
            throw new Exception( $e->getMessage() );
        }
    }

    // ---------------------------------
    // 함수명	: list_delete
    // 기능		: DB delete
    // 파라미터	: Array       $list_no
    // 리턴값	: 없음
    // ---------------------------------
    function list_delete(&$param_no)
    {
        $sql =
            " DELETE FROM "
            ." to_do_list_info " //---------------테이블 명 정해지면 수정
            ." WHERE "
            ." list_no = :list_no" //--------------------리스트 넘버(넘어오는 값)이 정해지면 수정
            ;
        $arr_prepare =
                array(
                    ":list_no" => $param_no["list_no"] //-----------------------리스트 넘버(넘어오는 값)이 정해지면 수정
                );
        $conn=null;

        try
        {
            db_conn($conn);
            $conn->beginTransaction();
            $stmt = $conn->prepare($sql);
            $stmt->execute($arr_prepare);
            $conn->commit();
        }
        catch (Exception $e)
        {
            $conn->rollback();
            return $e->getMessage();
        }
        finally
        {
            $conn = null;
        }
    }
    
    //------------------------------------
    // 함수명       : detali_to_do_list
    // 기능         : 리스트의 상세 내용 출력
    // 파라미터     : array       $param_no
    // 리턴값       : 
    //------------------------------------
    function select_to_do_list_no( &$param_no )
    {
        $sql =
            " SELECT "
            ."   list_title "
            ."  ,list_start_time "
            ."  ,list_start_minute "
            ."  ,list_end_time "
            ."  ,list_end_minute "
            ."  ,list_memo "
            ." FROM "
            ."  to_do_list_info "
            ." WHERE "
            ."  list_no = :list_no "
            ;

        $arr_prepare =
            array(
                ":list_no"   => $param_no
            );

        $conn = null;

        try
        {
            db_conn( $conn );
            $stmt = $conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
        finally
        {
            $param_conn = null;
        }
        return $result[0];
    }
?>