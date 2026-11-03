<?php
header('Content-Type: text/html; charset=UTF-8');

if (!isset($_GET['chon']) || !is_string($_GET['chon'])) {
    http_response_code(400);
    echo '<p class="message error">Lựa chọn bảng không hợp lệ.</p>';
    exit;
}

$tables = array(
    'giaovien' => 'Giáo viên',
    'sinhvien' => 'Sinh viên',
    'hocphan' => 'Học phần'
);
$selected = $_GET['chon'];

if (!isset($tables[$selected])) {
    http_response_code(400);
    echo '<p class="message error">Chỉ hỗ trợ các bảng giaovien, sinhvien và hocphan.</p>';
    exit;
}

require_once __DIR__ . '/database.class.php';

try {
    $dao = new Dao('root', '', 'udn');
    $dao->table('SELECT * FROM `' . $selected . '`', $tables[$selected]);
} catch (RuntimeException $e) {
    error_log('Unable to display selected table: ' . $e->getMessage());
    http_response_code(500);
    echo '<p class="message error">Không thể đọc dữ liệu. Hãy kiểm tra database udn và cấu trúc bảng.</p>';
}
