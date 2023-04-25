<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/Project/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER", SRC_ROOT."header_to_do_list.php" );
define( "PROFILE", SRC_ROOT."profile_to_do_list.php" );
define( "FOOTER", SRC_ROOT."footer_to_do_list.php");
include_once( URL_DB ); // db_common.php 불러옴

$http_method = $_SERVER["REQUEST_METHOD"]; // 값이 GET 인지 POST인지 확인

if($http_method === "GET") // GET값 받은거
{
  $list_no = 0; // 변수 생성
  if( array_key_exists( "list_no", $_GET ) ) // 상세 페이지에서 받아온 GET 값에서 key 이름이 "list_no" 가 있는지 유무 확인
  {
    $list_no = $_GET["list_no"]; // 받아온 GET 값 중에 "list_no" key값이 있으면,  key값이 "list_no" 인 value 값을 변수에 저장
  }
  $result_info = select_list_no( $list_no ); // list_no에 해당하는 정보를 가져와서 변수에 저장
}
else
{
  $arr_post = $_POST; // submit버튼 눌렀을 때 POST방식으로 값을 받아서 변수 저장
  update_list($arr_post); // 함수에 배열을 보내서 db에 내용 변경
  header("Location: detail_to_do_list.php?list_no=".$arr_post["list_no"]); // submit 버튼 눌러서 수정 완료 후 수정된 게시글 번호의 detail 페이지로 넘어가기
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
  <link rel="stylesheet" href="./common/css_common.css">
  <link rel="stylesheet" href="./common/update_to_do_list.css">
</head>
<body>
  <div class="con">
    <!-- 헤더 --> <!-- 헤더랑 프로필 include once로 파일을 연결 -->
    <?php include_once( URL_HEADER ); ?>
    <br>
    <!-- 프로필 -->
    <?php include_once( PROFILE ) ?>
    <div class="con1">
      <form action="" method="post">  <!-- post로 값을 넘겨줌 -->
        <!-- hidden 게시글 번호 -->  <!-- post로 넘겨줄때 name에 적은 값이 key가 되고 value에 적은 값이 value가 됨 -->
        <input type="hidden" name="list_no" value="<?php echo $result_info["list_no"]?>"> <!-- list_no 화면에 표시할 필요는 없지만 해당 번호의 정보를 가져오고 post로 정보를 보내주려면 list_no가 필요하기 때문에 hidden을 사용해줌 -->
        <div class="update_title">
          <h2>리스트 수정</h2>
        </div>
        <div class="update_list_ti">
          <!-- 제목 -->
          <label for="title">제목 </label>
          <input type="text" name="list_title" id="title" value="<?php echo $result_info["list_title"]?>" required placeholder="제목" autofocus>
        </div>
        <div class="update_time">
          <!-- 시작 시간 -->
          <label for="start_time">시작 시간</label> <!-- min, max값 적용 -->
          <input  type="number" name="list_start_time" id="start_time" min=00 max=23 value="<?php echo $result_info['list_start_time']?>"> :
          <input  type="number" name="list_start_minute" id="start_min" min=00 max=59 value="<?php echo $result_info['list_start_minute']?>">
          <!-- 종료 시간 -->
          <label for="end_time">종료 시간</label>
          <input type="number" name="list_end_time" id="end_time" min=00 max=23 value="<?php echo $result_info['list_end_time']?>"> :
          <input type="number" name="list_end_minute" id="end_min" min=00 max=59 value="<?php echo $result_info['list_end_minute']?>">
        </div>
        <div class="update_memo">
          <!-- 메모 -->
          <label for="memo">메모 :</label>
          <textarea name="list_memo" id="memo" cols="30" rows="10" placeholder="메모" ><?php echo $result_info["list_memo"]?></textarea>
        </div>
        <div class="update_radio">
          <!-- 라디오 버튼 --> <!-- 이미 완료 된 리스트일 경우 완료에 체크 돼있음, 미완료 리스트일 경우 미완료에 체크 돼있음 -->
          <input type="radio" name="list_comp_flg" id="done" value=1 <?php if($result_info["list_comp_flg"] === "1") { echo "checked"; }?>>
          <label for= "done">완료</label>
          <input type="radio" name="list_comp_flg" id="yet" value=0  <?php if($result_info["list_comp_flg"] === "0") { echo "checked"; }?>>
          <label for="yet">미완료</label>
        </div>
        <!-- 버튼들 -->
        <div class="update_buttons">
          <button type="submit">수정</button>
          <a href="detail_to_do_list.php?list_no=<?php echo $result_info["list_no"]?>" class="canc_button">취소</a> <!-- 클릭시 상세페이지로 이동 -->
          <a href="delete_to_do_list.php?list_no=<?php echo $result_info["list_no"]?>" class="del_button">삭제</a> <!-- 클릭시 삭제페이지로 이동 -->
        </div>
      </form>
    </div>
  </div>
  <?php include_once( FOOTER ); ?>
</body>
</html>