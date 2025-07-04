<?php
// 1. 데이터베이스 연결 파일을 불러옵니다.
include 'db_connect.php';

// 2. edit.php 폼에서 전송된 데이터를 받습니다. (id 포함)
$post_id = $_POST['id'];
$author = $_POST['author'];
$title = $_POST['title'];
$content = $_POST['content'];

// 3. SQL 쿼리 준비 (UPDATE)
// `posts` 테이블에서 특정 `id`를 가진 행의 `title`, `content`, `author` 값을 수정합니다.
$sql = "UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?";

// 4. Prepared Statement 객체 생성
$stmt = $conn->prepare($sql);

// 5. 파라미터 바인딩
// sssi는 전달될 파라미터 4개의 타입을 의미 (string, string, string, integer)
$stmt->bind_param("sssi", $title, $content, $author, $post_id);

// 6. 쿼리 실행
if ($stmt->execute()) {
    // 수정 성공 시
    echo "<script>
            alert('게시글이 성공적으로 수정되었습니다.');
            // 수정된 글의 상세 보기 페이지로 이동
            location.href = 'view.php?id=" . $post_id . "';
          </script>";
} else {
    // 수정 실패 시
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 7. 리소스 정리 및 연결 종료
$stmt->close();
$conn->close();
?>