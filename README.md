# API GUIDE
### Đăng ký tài khoản mới (POST):
```
localhost:8000/api/register
```

### Đăng nhập, nhận token (POST):
```
localhost:8000/api/login
```

### Đăng xuất, thu hồi token (DELETE):
```markdown
localhost:8000/api/logout
```
>_Yêu cầu đăng nhập với Sanctum token_

### Lấy thông tin user đang đăng nhập (GET):
```markdown
localhost:8000/api/user
```
>*Yêu cầu đăng nhập với Sanctum token*
---
### Thêm bài viết mới (POST):
```markdown
localhost:8000/api/add/post
```
>*Yêu cầu đăng nhập với Sanctum token*

### Sửa bài viết theo id (PATCH):
```markdown
localhost:8000/api/edit/post/{post}
```
>_Yêu cầu đăng nhập với Sanctum token_

### Xoá bài viết theo id (DELETE):
```markdown
localhost:8000/api/delete/post/{id}
```
>*Yêu cầu đăng nhập với Sanctum token*

### Lấy danh sách tất cả bài viết (GET):
```markdown
localhost:8000/api/posts
```
### Lấy chi tiết bài viết theo id (GET):
```markdown
localhost:8000/api/post/{id}
```
### Thêm bình luận cho bài viết (POST):
```markdown
localhost:8000/api/comment
```
>*Yêu cầu đăng nhập với Sanctum token*

### Like một bài viết (POST):
```markdown
localhost:8000/api/like
```
>*Yêu cầu đăng nhập với Sanctum token*

### Unlike (bỏ thích) một bài viết (DELETE):
```markdown
localhost:8000/api/unlike
```
>*Yêu cầu đăng nhập với Sanctum token*
