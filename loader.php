<?php
/**
 * PHP-Auth 라이브러리의 모든 클래스를 자동으로 불러오는 오토로더(Autoloader)
 */
spl_autoload_register(function ($class) {
    // delight-im/php-auth 라이브러리의 네임스페이스인지 확인합니다.
    $prefix = 'Delight\\Auth\\';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // 다른 라이브러리 클래스이면, 아무것도 하지 않습니다.
        return;
    }

    // 네임스페이스를 제외한 나머지 클래스 이름을 가져옵니다.
    $relative_class = substr($class, $len);

    // 네임스페이스 구분자(\)를 폴더 구분자(/)로 바꾸고 .php를 붙여 파일 경로를 만듭니다.
    $file = __DIR__ . '/lib/Auth/src/' . str_replace('\\', '/', $relative_class) . '.php';

    // 만약 파일이 존재하면, 불러옵니다.
    if (file_exists($file)) {
        require $file;
    }
});