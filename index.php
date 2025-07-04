<?php
// 1. 데이터베이스 연결 파일을 불러옵니다.
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>나의 게시판</title>
    <style>
        /* 간단한 스타일링 */
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .title-link { text-decoration: none; color: #333; }
        .title-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h1>나의 게시판</h1>
<a href="write.php" style="display: inline-block; padding: 10px 15px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">새 글 작성</a>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 2. SQL 쿼리 작성: posts 테이블의 모든 데이터를 id 내림차순으로 선택
            $sql = "SELECT id, title, author, created_at FROM posts ORDER BY id DESC";

            // 3. 쿼리 실행
            $result = $conn->query($sql);

            // 4. 결과 확인 및 데이터 출력
            if ($result->num_rows > 0) {
                // 데이터가 한 개 이상 있는 경우
                // fetch_assoc()는 결과를 연관 배열로 한 줄씩 가져옴
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td><a href='view.php?id=" . $row["id"] . "' class='title-link'>" . $row["title"] . "</a></td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td><a href='edit.php?id=" . $row["id"] . "'>수정</a> | 
                              <a href='process_delete.php?id=" . $row["id"] . "' onclick='return confirm(\"정말로 이 게시글을 삭제하시겠습니까?\");'>삭제</a></td>";
                    echo "</tr>";
                }
            } else {
                // 데이터가 없는 경우
                echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
            }

            // 5. 데이터베이스 연결 종료
            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>