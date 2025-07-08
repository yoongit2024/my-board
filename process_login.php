<?php
// 1. db_connect.php를 불러옵니다.
require_once __DIR__ . '/db_connect.php';

// 2. 폼에서 전송된 데이터를 받습니다.
$username = $_POST['username'];
$password = $_POST['password'];

// 3. 회원가입 때와 동일한 규칙으로 가짜 이메일을 만들어줍니다.
$email = $username . '@localhost.local';

try {
    // 4. login 함수에 가짜 이메일을 전달하여 로그인을 시도합니다.
    $auth->login($email, $password);

    // 로그인 성공 시
    echo "<script>
            alert('로그인에 성공했습니다. 관리자 페이지로 이동합니다.');
            location.href = 'admin.php'; // 관리자 페이지로 이동
          </script>";
}
catch (\Delight\Auth\InvalidEmailException $e) {
    // 이메일(아이디)이 DB에 존재하지 않는 경우
    die('존재하지 않는 아이디입니다.');
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    die('잘못된 비밀번호입니다.');
}
catch (\Delight\Auth\EmailNotVerifiedException $e) {
    die('이메일 인증이 필요합니다.'); // 우리는 사용하지 않지만 만약을 위해 둡니다.
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    die('너무 많은 로그인 시도를 하셨습니다. 잠시 후 다시 시도하세요.');
}
catch (\Exception $e) {
    die('알 수 없는 오류가 발생했습니다.');
}
?>