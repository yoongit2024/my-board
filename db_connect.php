<?php
// PHP 세션을 시작합니다. 로그인 상태를 유지하기 위해 모든 페이지 상단에 필요합니다.
session_start();

// 1. 컴포저의 오토로더(Autoloader)를 불러옵니다.
// 이 파일 하나만 있으면 vendor 폴더의 모든 라이브러리를 자동으로 사용할 수 있습니다.
require_once __DIR__ . '/vendor/autoload.php';

// 2. 환경별 DB 연결 정보가 담긴 config.php 파일을 불러옵니다.
require_once __DIR__ . '/config.php';
// 이제 $host, $db_name, $user, $password 변수를 사용할 수 있습니다.

// 3. PDO 방식으로 데이터베이스에 연결
try {
    // config.php에서 불러온 변수들을 사용하여 PDO 객체를 생성합니다.
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $password);

    // PDO 연결에서 오류가 발생하면 예외(Exception)를 던지도록 설정합니다.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // 연결 실패 시, 에러 메시지를 보여주고 스크립트 실행을 중지합니다.
    die("데이터베이스 연결 실패: " . $e->getMessage());
}

// 4. 모든 페이지에서 사용할 Auth 객체 생성
// 이제 $auth 변수를 통해 로그인, 회원가입 등 모든 인증 기능을 사용할 수 있습니다.
$auth = new \Delight\Auth\Auth($db);
?>