<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER", SRC_ROOT."header_to_do_list.php" );
include_once( URL_DB ); // db_common.php 불러옴

$http_method = $_SERVER["REQUEST_METHOD"];

if($http_method === "GET") // GET값 받은거
{
  $list_no = 1; // Ask ) 0, 1 숫자 상관 없나??
  if( array_key_exists( "list_no", $_GET ) )
  {
    $list_no = $_GET["list_no"];
  }
  $result_info = select_list_no( $list_no ); 
}
else
{
  $arr_post = $_POST; // POST값 보낼거
  $arr_info =
    array(
      "list_title"             => $arr_post["list_title"]
        ,"list_memo"           => $arr_post["list_memo"]
        ,"list_comp_flg"       => $arr_post["list_comp_flg"]
        ,"list_start_time"     => $arr_post["list_start_time"]
        ,"list_start_minute"   => $arr_post["list_start_minute"]
        ,"list_end_time"       => $arr_post["list_end_time"]
        ,"list_end_minute"     => $arr_post["list_end_minute"]
        ,"list_no"             => $arr_post["list_no"]
    );
  
  $result_cnt = update_list( $arr_info );
  header("Location: detail_to_do_list.php?list_no=".$arr_post["list_no"]); // 수정 완료 후 해당 게시글 번호의 detail 페이지로 넘어가기
  exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>리스트 수정 페이지</title>
</head>
<body>
  <!-- 헤더 -->
  <?php include_once( URL_HEADER ); ?>
  <form action="" method="post">
    <!-- hidden 게시글 번호 -->
    <input type="hidden" name="list_no" value="<?php echo $result_info["list_no"]?>"> <!-- list_no 화면에 표시할 필요는 없지만 해당 번호의 정보를 가져와야함으로 hidden을 사용해줌 -->
    <br>
    <!-- 제목 -->
    <input type="text" name="list_title" value="<?php echo $result_info["list_title"]?>" required>
    <br>
    <!-- 시작 시간 -->
    <label for="start_time">시작 시간</label> <!-- Ask ) name 같은 이름으로 해서 같이 값 넘겨주는게 맞는지?? -->
    <input type="text" name="list_start_time" id="start_time" value="<?php echo $result_info['list_start_time']?>">
    <input type="text" name="list_start_minute" id="start_min" value="<?php echo $result_info['list_start_minute']?>">
    <!-- 종료 시간 -->
    <label for="end_time">종료 시간</label>
    <input type="text" name="list_end_time" id="end_time" value="<?php echo $result_info['list_end_time']?>">
    <input type="text" name="list_end_minute" id="end_min" value="<?php echo $result_info['list_end_minute']?>">
    <br>
    <!-- 메모 칸 -->
    <textarea name="list_memo" id="memo" cols="30" rows="10" placeholder="메모"><?php echo $result_info["list_memo"]?></textarea>
    <br>
    <!-- 라디오 버튼 -->
    <input type="radio" name="list_comp_flg" id="done" value=1 >
    <label for="done">완료</label>
    <input type="radio" name="list_comp_flg" id="yet" value=0 checked>
    <label for="yet">미완료</label>
    <br>
    <button type="submit">수정</button>
    <button type="button">
      <a href="detail_to_do_list.php?list_no=<?php echo $result_info["list_no"]?>">취소</a>
    </button>
    <button type="button">
      <a href="delete_to_do_list.php?list_no=<?php echo $result_info["list_no"]?>">삭제</a>
    </button>
  </form>
    

</body>
</html>