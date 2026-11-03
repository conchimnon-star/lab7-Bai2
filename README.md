# Lab 7 - Bài 2: OOP with PHP

Trang PHP/MySQLi dùng lớp `Dao` để truy vấn các bảng `giaovien`, `sinhvien`, `hocphan`. Người dùng chọn bảng và trang dùng `XMLHttpRequest` để hiển thị kết quả mà không tải lại trang. Ứng dụng không tạo hoặc thay đổi database.

## Yêu cầu database

- MySQL đang chạy trong XAMPP.
- Database `udn` có sẵn ba bảng `giaovien`, `sinhvien`, `hocphan`.

Lớp `Dao` lấy tên cột từ metadata của kết quả truy vấn nên không giả định trước cấu trúc cột. Nếu database thiếu bảng, hãy cung cấp SQL gốc để đối chiếu; ứng dụng không tự tạo hay sửa schema và không dùng dữ liệu giả.

## Chạy trên XAMPP

1. Đặt các tệp này trong `D:\xampp\htdocs\Lab7-Bai2`.
2. Khởi động Apache và MySQL trong XAMPP Control Panel.
3. Đảm bảo database `udn` và các bảng gốc đã có sẵn.
4. Mở `http://localhost/Lab7-Bai2/index.php`, sau đó chọn bảng muốn xem.

Thông tin kết nối mặc định: `localhost`, user `root`, mật khẩu rỗng, database `udn`; kết nối dùng charset `utf8mb4`.
