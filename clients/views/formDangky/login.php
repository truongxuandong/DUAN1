<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./clients/assets/css/loginclient.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Welcome!</title>
</head>

<body>

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Form đăng nhập -->
                <form action="?act=login" method="POST" class="sign-in-form">
                    <?php
                    // session_start();

                    // Hiển thị thông báo lỗi nếu có
                    if (isset($_SESSION['error'])) {
                        echo "<p style='color: red; text-align: center;'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']); // Xóa thông báo sau khi hiển thị
                    }

                    // Hiển thị thông báo thành công nếu có
                    if (isset($_SESSION['success'])) {
                        echo "<p style='color: green; text-align: center;'>" . $_SESSION['success'] . "</p>";
                        unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị
                    }
                    ?>
                    <h2 class="title">Sign In</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <input type="submit" value="Login" class="btn solid">
                    <p class="social-text">Or Sign In with Social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Bạn chưa có tài khoản ?</h3>
                    <p>Vui lòng đăng ký tại đây.</p>
                    <button class="btn transparent" id="sign-up-btn">
                        <a href="<?= '?act=register' ?>">Sign Up</a>
                    </button>
                </div>
            </div>
            <!-- <div class="panel right-panel">
                <div class="content">
                    <h3>One of Us?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, error.</p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign In
                    </button>
                </div> -->
        </div>
    </div>
    </div>
    <!-- <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });
        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
    </script> -->
</body>

</html>