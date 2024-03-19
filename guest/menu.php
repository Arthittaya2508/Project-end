<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
</head>

<body>

    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo4.png" width="70px" height="70px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">
                            <i class="fa-solid fa-house"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            </i> Product
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="all_products.php">All Product</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="necklece.php">สร้อยคอ</a></li>
                            <li><a class="dropdown-item" href="rings.php">แหวน</a></li>
                            <li><a class="dropdown-item" href="bracelets.php">กำไลแขน</a></li>
                            <li><a class="dropdown-item" href="earrings.php">ต่างหู</a></li>

                        </ul>
                    </li>

                </ul>


                <form class="d-flex" method="POST" action="search.php">
                    <input class="form-control me-2" type="text" name="pname" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success btn-pink" type="submit">Search</button>
                </form>
                <a href="#" id="loginButton" class="login m-4 text-white"><i class="fa-solid fa-right-to-bracket"></i>
                    Login</a>
                <div id="loginModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>

                        <h2>Login Form</h2>
                        <form class="formlog" method="POST" action="login_check.php">
                            <input type="text" name="username" class="form-control" required placeholder="username">
                            <br>
                            <input type="password" name="password" class="form-control" required placeholder="password">
                            <br>
                            <?php
                            if (isset($_SESSION["Error"])) {
                                echo "<div class='text-danger'> ";
                                echo $_SESSION["Error"];
                                echo "</div>";
                            }
                            ?>
                            <input type="submit" name="submit" class="btn btn-success" value="Login">
                            <br><br>
                            <a href="register.php" class="text-left"> Register </a>
                        </form>
                    </div>
                </div>
                <a href="#" id="registerButton" class="rgt  text-white"><i class="fa-solid fa-pen-to-square"></i>
                    Register</a>
                <div id="registerModal" class="modal">
                    <div class="modal-content">

                        <h2>Register Form</h2>
                        <span class="close">&times;</span>
                        <form method="POST" action="insert_register.php" enctype="multipart/form-data">
                            ชื่อ <input type="text" name="firstname" class="form-control" required>
                            นามสกุล <input type="text" name="lastname" class="form-control" required>
                            ที่อยู่ <textarea class="form-control" required placeholder="ที่อยู่..." name="address" rows="3"> </textarea>
                            เบอร์โทรศัพท์ <input type="number" name="phone" class="form-control" required>
                            เพิ่มรูปโปรไฟล์ <input type="file" name="image" class="form-control-file" accept="image/*" required><br>
                            Username <input type="text" name="username" maxlength="10" class="form-control" required>
                            Password <input type="password" name="password" maxlength="10" class="form-control" required> <br>
                            <input type="submit" name="submit" value="บันทึก" class="btn btn-success">
                            <input type="reset" name="concel" value="ยกเลิก" class="btn btn-success"> <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        var loginBtn = document.getElementById("loginButton");
        var registerBtn = document.getElementById("registerButton");
        var loginModal = document.getElementById("loginModal");
        var registerModal = document.getElementById("registerModal");
        var closeBtn = document.getElementsByClassName("close");

        loginBtn.onclick = function() {
            loginModal.style.display = "block";
        }

        registerBtn.onclick = function() {
            registerModal.style.display = "block";
        }

        for (var i = 0; i < closeBtn.length; i++) {
            closeBtn[i].onclick = function() {
                loginModal.style.display = "none";
                registerModal.style.display = "none";
            }
        }

        window.onclick = function(event) {
            if (event.target == loginModal || event.target == registerModal) {
                loginModal.style.display = "none";
                registerModal.style.display = "none";
            }
        }
    </script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</body>

</html>