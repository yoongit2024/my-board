<?php
// 1. DB 연결 및 Auth 객체 생성을 위해 db_connect.php를 불러옵니다.
require_once __DIR__ . '/db_connect.php';

try {
    // 2. 라이브러리의 logOut 함수를 호출하여 로그아웃을 처리합니다.
    $auth->logOut();
    
    // 로그아웃 성공 시
    echo "<script>
            alert('로그아웃 되었습니다.');
            location.href = 'index.php'; // 메인 페이지로 이동
          </script>";
}
catch (\Delight\Auth\NotLoggedInException $e) {
    // 이미 로그아웃된 상태일 때의 예외 처리
    echo "<script>
            alert('이미 로그아웃된 상태입니다.');
            location.href = 'index.php';
          </script>";
}
?>