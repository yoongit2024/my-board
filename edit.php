<?php
// 1. DB 연결 및 데이터 가져오기 (view.php와 거의 동일)
include 'db_connect.php';

$post_id = $_GET['id'];

$sql = "SELECT id, title, content, author FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    die("해당 게시글을 찾을 수 없습니다.");
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
    <style>
        body { font-family: sans-serif; }
        .container { width: 800px; margin: 20px auto; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea { height: 200px; resize: vertical; }
        .submit-btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>게시글 수정</h1>
        <form action="process_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            
            <div class="form-group">
                <label for="author">작성자:</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required>
            </div>
            <div class="form-group">
                <label for="title">제목:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">내용:</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            <button type="submit" class="submit-btn">수정 완료</button>
        </form>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>