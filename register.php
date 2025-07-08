<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
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
            width: 100%; padding: 10px; background-color: #007BFF; color: white;
            border: none; border-radius: 5px; cursor: pointer; font-size: 16px;
        }
        .submit-btn:hover { background-color: #0056b3; }
        .login-link { text-align: center; margin-top: 20px; }
        .login-link a { color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>회원가입</h2>
        <form action="process_register.php" method="POST">
            <div class="form-group">
                <label for="username">사용자 아이디:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">비밀번호:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">가입하기</button>
        </form>
        <div class="login-link">
            <p>이미 계정이 있으신가요? <a href="login.php">로그인</a></p>
        </div>
    </div>
</body>
</html>