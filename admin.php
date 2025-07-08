<?php
// 나중에 이 부분에 관리자만 접속할 수 있도록 하는 PHP 코드를 추가할 것입니다.
// 지금은 우선 화면 디자인에 집중합니다.
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>관리자 페이지</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #f4f7f6;
        }
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #34495e;
        }
        .main-content {
            flex-grow: 1;
            padding: 40px;
        }
        .main-content h1 {
            margin-top: 0;
            color: #34495e;
        }
        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <h2>관리자 패널</h2>
            <ul>
                <li><a href="admin.php" class="active">대시보드</a></li>
                <li><a href="admin_users.php">회원 관리</a></li>
                <li><a href="admin_posts.php">게시글 관리</a></li>
                <li><a href="index.php" target="_blank">사이트 바로가기</a></li>
                <li><a href="logout.php">로그아웃</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <h1>대시보드</h1>
            <div class="card">
                <h3>환영합니다, 관리자님!</h3>
                <p>이곳에서 웹사이트의 회원 정보와 게시글을 관리할 수 있습니다.</p>
                <p>왼쪽 메뉴를 클릭하여 원하는 작업을 시작하세요.</p>
                <ul>
                    <li><strong>회원 관리:</strong> 가입한 회원 목록을 보고 역할을 변경하거나 회원을 관리합니다.</li>
                    <li><strong>게시글 관리:</strong> 작성된 모든 게시글을 보고, 부적절한 게시글을 삭제하거나 수정합니다.</li>
                </ul>
            </div>
        </main>
    </div>
</body>
</html>