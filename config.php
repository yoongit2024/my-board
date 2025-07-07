<?php
// 데이터베이스 연결 정보
$host = "localhost"; // 호스트 (우리가 바꾼 포트 번호 명시)
$user = "yoon25";          // 사용자 이름
$password = "wjsghkqkedj1212!";          // 비밀번호 (우리는 비워두기로 했죠)
$db_name = "yoon25"; // 우리가 만든 데이터베이스 이름

// MySQLi 객체를 사용해 데이터베이스에 연결
$conn = new mysqli($host, $user, $password, $db_name);

// 연결 성공 여부 확인
if ($conn->connect_error) {
    // 연결 실패 시, 에러 메시지를 보여주고 스크립트 실행을 중지
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 연결 성공 시, 문자셋을 utf8mb4로 설정 (한글 깨짐 방지)
$conn->set_charset("utf8mb4");

// echo "데이터베이스 연결 성공!"; // 연결 테스트 후에는 이 줄을 주석 처리하거나 삭제하는 것이 좋습니다.
?>
