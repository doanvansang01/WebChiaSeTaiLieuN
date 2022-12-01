<html>
    <head>
        <meta charset="utf8">
        <title>Đổi mật khẩu</title>
        <link rel="stylesheet" href="css/doimatkhau.css">
    </head>
    <body>
        <!-- auth-form là khung chứa toàn bộ đăng ký đăng nhập -->
        <div class="auth-form" align="center">
            <div class="auth-form__noidung">
                <div class="auth-form__header">
                    <h3 class="auth-form__dmk">Đổi mật khẩu</h3>              
                </div>
                <div class="auth-form__form-input">
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu cũ" name="mkcu">
                    </div>
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu mới" name="mkmoi">
                    </div>
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu mới" name="remkmoi">
                    </div>
                </div>
                <div class="auth-form__controls">
                    <button class="btn auth-form__controls-back">Trở Lại</button>
                    <button class="btn btn-primary" type="submit">Đồng ý</button>
                </div>
            </div>
        </div>
		
		<?php
			if(isset($_SESSION['dn']) && isset()&&isset())
		?>
    </body>
</html>