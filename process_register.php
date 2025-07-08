<?php
// 1. db_connect.php를 불러옵니다.
require_once __DIR__ . '/db_connect.php';

// 2. 폼에서 전송된 데이터를 받습니다.
$username = $_POST['username'];
$password = $_POST['password'];

// 3. 라이브러리가 요구하는 이메일 형식을 만들어줍니다.
// 사용자가 입력한 아이디 뒤에 가짜 도메인을 붙입니다.
$email = $username . '@localhost.local';

try {
    // 4. register 함수에 가짜 이메일과 실제 아이디를 전달합니다.
    $userId = $auth->register($email, $password, $username);

    // 회원가입 성공 시
    echo "<script>
            alert('회원가입이 성공적으로 완료되었습니다. ID: " . htmlspecialchars($username) . "');
            location.href = 'login.php'; // 로그인 페이지로 이동
          </script>";

}
catch (\Delight\Auth\InvalidEmailException $e) {
    // 이 오류는 이제 아이디 형식 오류를 의미합니다.
    die('아이디는 영문, 숫자, 특수문자(-, _)만 사용 가능합니다.');
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    die('유효하지 않은 비밀번호입니다. 더 강력한 비밀번호를 사용하세요.');
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
    die('이미 사용 중인 아이디입니다.');
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    die('너무 많은 요청이 발생했습니다. 잠시 후 다시 시도하세요.');
}
catch (\Exception $e) {
    die('알 수 없는 오류가 발생했습니다: ' . $e->getMessage());
}
?>