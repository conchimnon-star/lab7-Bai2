<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOP with PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>OOP with PHP</h1>

        <label for="chon">Chọn bảng dữ liệu:</label>
        <select id="chon" name="chon" onchange="ajax()">
            <option value="">-- Chọn bảng --</option>
            <option value="giaovien">Giáo viên – giaovien</option>
            <option value="sinhvien">Sinh viên – sinhvien</option>
            <option value="hocphan">Học phần – hocphan</option>
        </select>

        <div id="info" aria-live="polite">
            <p class="message">Chọn một bảng để xem dữ liệu.</p>
        </div>
    </main>

    <script>
        function ajax() {
            var select = document.getElementById('chon');
            var output = document.getElementById('info');
            var table = select.value;

            if (table === '') {
                output.textContent = 'Chọn một bảng để xem dữ liệu.';
                output.className = 'message';
                return;
            }

            output.textContent = 'Đang tải dữ liệu...';
            output.className = 'message';

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        output.innerHTML = xhr.responseText;
                    } else {
                        output.textContent = 'Không thể tải dữ liệu. Vui lòng kiểm tra kết nối database và thử lại.';
                        output.className = 'message error';
                    }
                }
            };
            xhr.onerror = function () {
                output.textContent = 'Lỗi kết nối khi tải dữ liệu.';
                output.className = 'message error';
            };
            xhr.open('GET', 'showTable.php?chon=' + encodeURIComponent(table), true);
            xhr.send(null);
        }
    </script>
</body>
</html>
