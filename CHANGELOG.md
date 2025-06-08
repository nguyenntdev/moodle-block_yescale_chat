# Changelog

## [1.1.0] - 2025-11-01
### Added
- Áp dụng Fluent Design cho giao diện MiraGPT trên Moodle.
- Hệ thống shadow ramp (elevation) cho chiều sâu UI.
- Hiệu ứng reveal highlight khi hover nút, FAB với shadow 8px và hiệu ứng scale khi tương tác.
- Parallax gradient cho nền lịch sử chat (không dùng hình ảnh).
- Entrance animation (fade-in) cho cửa sổ chat, smooth scroll cho lịch sử hội thoại.
- Micro-interaction: icon gửi tin nhắn (paper-plane) xoay 45° và translateY(-5px) khi gửi.
- Cải thiện accessibility: contrast ≥4.5:1, focus indicator rõ ràng, ARIA labels, hỗ trợ screen reader.

### Changed
- Giao diện tối giản, hiện đại, ít màu sắc, tập trung vào trải nghiệm người dùng.

### Fixed
- Đảm bảo UI đáp ứng tốt trên mọi thiết bị.

## [1.1.1] - 2025-11-01
### Changed
- Nút gửi tin nhắn (send) chuyển sang màu Fluent blue (#2563eb) đậm, tương phản cao trên nền trắng.
- Icon/text trên nút gửi chuyển sang màu trắng, đảm bảo accessibility.
- Hiệu ứng hover/focus đậm nét, tăng nhận diện và trải nghiệm Fluent.

## [1.2.0] - 2025-11-01
### Changed
- Tên người dùng và trợ lý (Assistant) hiển thị phía trên nội dung tin nhắn, nằm trong bubble, căn chỉnh đẹp, rõ ràng.
- Font tên nhỏ, màu nhạt, căn phải cho user, căn trái cho bot.
- Loại bỏ hiển thị tên bằng CSS :before, chuyển sang HTML semantic, dễ kiểm soát và responsive hơn.

## [1.2.1] - 2025-11-01
### Changed
- Bubble chat bo góc 12px, padding lớn hơn, viền dày hơn theo Fluent Design.
- Tên user/assistant luôn nằm trên cùng, chiếm toàn bộ chiều ngang bubble, căn phải cho user, căn trái cho bot, margin rõ ràng.
- Đảm bảo tên luôn thẳng hàng với nội dung, không bị lệch, giao diện đồng nhất và hiện đại hơn.

## [1.2.2] - 2025-11-01
### Changed
- Bo tròn cả 4 góc của ô nhập chat (input box), border dày 2px màu xanh Fluent (#2563eb) rõ nét, hiện đại hơn.

## [1.3.0] - 2025-11-01
### Changed
- Sử dụng font hiện đại, chuẩn Fluent Design: 'Segoe UI', system-ui, Noto Sans, Roboto, v.v.
- Tăng độ tương phản màu chữ: #111 trên nền sáng, #fff trên nền xanh đậm, giúp dễ đọc hơn trên mọi thiết bị.

## [1.3.1] - 2025-11-01
### Changed
- Card title (YeScale Chat) và nút popout (mở rộng cửa sổ chat) nằm cùng một dòng, căn hai bên, giao diện hiện đại, icon rõ ràng.
- Cải thiện căn chỉnh, spacing và font cho tiêu đề block chat.

## [1.4.0] - 2025-11-01
### Changed
- Nút popout (mở rộng chat) nằm cạnh nút làm mới (refresh) trong cùng một dòng với khung nhập chat.
- Toàn bộ giao diện chat sử dụng font hiện đại Lato, Montserrat, chuẩn Fluent Design, tăng độ dễ đọc và thẩm mỹ.

## [1.4.1] - 2025-11-01
### Changed
- Khoảng cách giữa ô nhập, nút gửi, nút làm mới, và nút popout trong khung nhập chat được căn đều, giao diện gọn gàng, hiện đại hơn.

## [1.4.2] - 2025-11-01
### Changed
- Tăng khoảng trống giữa các chat bubble, giúp giao diện thoáng, dễ đọc và hiện đại hơn.

## [1.4.3] - 2025-11-01
### Changed
- Nền giao diện chuyển sang màu nhạt, không còn gradient, tạo cảm giác nhẹ nhàng, hiện đại.
- Thêm viền rõ nét cho control bar và khung chat log, giúp phân tách và nổi bật các vùng chức năng. 