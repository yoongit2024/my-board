<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <style>
        body { font-family: sans-serif; }
        .container { width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input {
            width: 100%; padding: 8px; border: 1px solid #ddd;
            border-radius: 4px; box-sizing: border-box;
        }
        .submit-btn {
            width: 100%; padding: 10px; background-color: #28a745; color: white;
            border: none; border-radius: 5px; cursor: pointer; font-size: 16px;
        }
        .submit-btn:hover { background-color: #218838; }
        .register-link { text-align: center; margin-top: 20px; }
        .register-link a { color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>로그인</h2>
        <form action="process_login.php" method="POST">
            <div class="form-group">
                <label for="username">사용자 아이디:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">비밀번호:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">로그인</button>
        </form>
        <div class="register-link">
            <p>계정이 없으신가요? <a href="register.php">회원가입</a></p>
        </div>
    </div>
</body>
</html>