<?php
// 1. 데이터베이스 연결 파일을 불러옵니다.
include 'db_connect.php';

// 2. write.php 폼에서 전송된 데이터를 받습니다.
// $_POST는 method="POST"로 보낸 데이터를 받는 PHP의 약속(전역 변수)입니다.
$author = $_POST['author'];
$title = $_POST['title'];
$content = $_POST['content'];

// 3. SQL 쿼리 준비 (보안을 위해 Prepared Statement 사용)
// `posts` 테이블에 `title`, `content`, `author` 값을 추가합니다.
// `id`와 `created_at`은 자동으로 생성되므로 포함시키지 않습니다.
$sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";

// 4. Prepared Statement 객체 생성
$stmt = $conn->prepare($sql);

// 5. 파라미터 바인딩
// sss는 전달될 파라미터 3개가 모두 문자열(string) 타입임을 의미합니다.
$stmt->bind_param("sss", $title, $content, $author);

// 6. 쿼리 실행
if ($stmt->execute()) {
    // 글쓰기 성공 시
    echo "<script>
            alert('게시글이 성공적으로 작성되었습니다.');
            location.href = 'index.php';
          </script>";
} else {
    // 글쓰기 실패 시
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 7. 리소스 정리 및 연결 종료
$stmt->close();
$conn->close();
?>