<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>새 글 작성</title>
    <style>
        body { font-family: sans-serif; }
        .container { width: 800px; margin: 20px auto; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* CKEditor의 높이를 조절하기 위한 스타일 */
        .ck-editor__editable {
            min-height: 400px;
        }
        .submit-btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #218838;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <h1>새 글 작성</h1>
        <form action="process_write.php" method="POST">
            <div class="form-group">
                <label for="author">작성자:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="title">제목:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">내용:</label>
                <div id="content"></div>
            </div>
            <textarea name="content" style="display:none;" id="hidden-content"></textarea>
            <button type="submit" class="submit-btn">작성 완료</button>
        </form>
    </div>

    <script>
        // 4. ClassicEditor를 'content' div에 적용
        let editor;
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .then( newEditor => {
                editor = newEditor; // 에디터 인스턴스를 변수에 저장
            } )
            .catch( error => {
                console.error( error );
            } );

        // 5. 폼 전송(submit) 이벤트가 발생하면, 에디터의 내용을 숨겨진 textarea로 복사
        document.querySelector('form').addEventListener('submit', function() {
            document.querySelector('#hidden-content').value = editor.getData();
        });
    </script>

</body>
</html>