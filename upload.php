<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = [
    'uploaded' => 0,
    'error' => ['message' => '알 수 없는 오류가 발생했습니다.']
];

if (isset($_FILES['upload']) && $_FILES['upload']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['upload']['tmp_name'];
    $fileName = $_FILES['upload']['name'];
    $fileSize = $_FILES['upload']['size'];
    $fileType = $_FILES['upload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = microtime(true) . '_' . uniqid() . '.' . $fileExtension;
    $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg', 'webp'];

    if (in_array($fileExtension, $allowedfileExtensions)) {
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $response['uploaded'] = 1;
            
            // ===================================================================
            // ✅ 이 부분이 핵심입니다! 이미지의 전체 URL을 생성합니다.
            // ===================================================================
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
            $host = $_SERVER['HTTP_HOST'];
            
            // 로컬 환경의 서브디렉토리 경로를 동적으로 추가 (예: /my-board/)
            // realpath()는 현재 파일의 절대 경로를 반환합니다.
            // str_replace()를 사용해 내 컴퓨터의 경로를 웹 경로로 바꿉니다.
            $projectFolder = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(realpath(__FILE__))));

            // 최종 URL 조합
            $url = $protocol . $host . $projectFolder . '/uploads/' . $newFileName;
            // ===================================================================

            $response['url'] = $url;
            unset($response['error']);
        } else {
            $response['error']['message'] = '파일을 서버로 옮기는 데 실패했습니다.';
        }
    } else {
        $response['error']['message'] = '허용되지 않는 파일 확장자입니다.';
    }
} else {
    $upload_error_code = isset($_FILES['upload']['error']) ? $_FILES['upload']['error'] : 'UNKNOWN';
    $response['error']['message'] = '파일 업로드 중 오류가 발생했습니다. 오류 코드: ' . $upload_error_code;
}

echo json_encode($response);
?>