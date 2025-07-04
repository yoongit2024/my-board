<?php
// 1. 데이터베이스 연결 파일을 불러옵니다.
include 'db_connect.php';

// 2. index.php에서 전달된 id 값을 가져옵니다.
// 링크(<a> 태그)를 통해 주소창으로 전달되었으므로 $_GET을 사용합니다.
$post_id = $_GET['id'];

// 3. SQL 쿼리 준비 (보안을 위해 Prepared Statement 사용)
// `posts` 테이블에서 특정 `id`를 가진 행을 삭제합니다.
$sql = "DELETE FROM posts WHERE id = ?";

// 4. Prepared Statement 객체 생성
$stmt = $conn->prepare($sql);

// 5. 파라미터 바인딩
// "i"는 전달될 파라미터 1개가 정수(integer) 타입임을 의미합니다.
$stmt->bind_param("i", $post_id);

// 6. 쿼리 실행
if ($stmt->execute()) {
    // 삭제 성공 시
    echo "<script>
            alert('게시글이 성공적으로 삭제되었습니다.');
            location.href = 'index.php'; // 목록 페이지로 이동
          </script>";
} else {
    // 삭제 실패 시
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 7. 리소스 정리 및 연결 종료
$stmt->close();
$conn->close();
?>