<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>새 글 작성</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* 페이지 전체에 'Noto Sans KR' 폰트를 기본으로 적용하여 가독성 향상 */
        body { font-family: 'Noto Sans KR', 'Malgun Gothic', sans-serif; }
        .container { width: 800px; margin: 20px auto; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input {
            width: 100%; padding: 8px; border: 1px solid #ddd;
            border-radius: 4px; box-sizing: border-box;
        }
        .ck-editor__editable { min-height: 400px; }
        .submit-btn {
            padding: 10px 20px; background-color: #28a745; color: white;
            border: none; border-radius: 5px; cursor: pointer; font-size: 16px;
        }
        .submit-btn:hover { background-color: #218838; }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <h1>새 글 작성</h1>
        <form id="write-form" action="process_write.php" method="POST">
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
                <div id="editor"></div>
            </div>
            <textarea name="content" style="display:none;" id="hidden-content"></textarea>
            <button type="submit" class="submit-btn">작성 완료</button>
        </form>
    </div>

    <script>
        let editor;

        CKEDITOR.ClassicEditor.create(document.querySelector('#editor'), {
            // 불필요한 모든 유료 플러그인 제거
            removePlugins: [
                'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory', 'PresenceList', 'Comments',
                'TrackChanges', 'TrackChangesData', 'RevisionHistory', 'Pagination',
                'WProofreader', 'MathType', 'DocumentOutline', 'TableOfContents', 'AIAssistant',
                'MultiLevelList', 'FormatPainter', 'Template', 'SlashCommand',
                'PasteFromOfficeEnhanced', 'CaseChange'
            ],
            // 툴바 설정은 그대로
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|',
                    'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'highlight', '|',
                    'alignment', '|', 'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                ],
                shouldNotGroupWhenFull: true
            },
            language: 'ko',

            // ✅ 2. 실용적인 폰트 크기 목록으로 수정
            fontSize: {
                options: [
                    10, 12, 14, 16, 18, 20, 24, 28, 32
                ],
                supportAllValues: true
            },

            // ✅ 3. 한국인이 많이 쓰는 웹 폰트 및 기본 폰트 목록으로 수정
            fontFamily: {
                options: [
                    'default',
                    'Noto Sans KR, sans-serif',
                    'Malgun Gothic, sans-serif',
                    'Dotum, sans-serif',
                    'Gulim, sans-serif',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Impact, Charcoal, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
           
           ckfinder: {
        uploadUrl: 'upload.php' // 이미지 업로드를 처리할 PHP 파일 경로
    }
})
.then(newEditor => {
    editor = newEditor;
})
.catch(error => {
    console.error('CKEditor initialization error:', error);
});

        document.querySelector('#write-form').addEventListener('submit', function() {
            if (editor) {
                document.querySelector('#hidden-content').value = editor.getData();
            }
        });
    </script>
</body>
</html>