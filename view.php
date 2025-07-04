<?php
include 'db_connect.php'; // 데이터베이스 연결

// 1. URL로부터 post_id 값을 가져옵니다.
$post_id = $_GET['id'];

// 2. SQL 쿼리 작성: 특정 id의 게시글만 선택합니다.
// SQL Injection이라는 해킹 공격을 방지하기 위해 prepared statement를 사용하는 것이 안전합니다.
$sql = "SELECT id, title, content, author, created_at FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id); // "i"는 전달될 파라미터가 정수(integer) 타입임을 의미
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "해당 게시글을 찾을 수 없습니다.";
    exit; // 게시글이 없으면 스크립트 종료
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .container { width: 800px; margin: 20px auto; background: #fff; padding: 20px; border: 1px solid #ddd; }
        .post-meta { color: #555; font-size: 0.9em; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .post-content { margin-top: 20px; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <p class="post-meta">
            작성자: <?php echo htmlspecialchars($post['author']); ?> | 
            작성일: <?php echo $post['created_at']; ?>
        </p>

        <div class="post-content">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>

        <hr style="margin-top: 20px;">
        <a href="index.php">목록으로 돌아가기</a>
    </div>
</body>
</html>
<?php
// 4. 리소스 정리 및 연결 종료
$stmt->close();
$conn->close();
?>