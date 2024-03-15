<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<style>
.login {
    display: inline-block;
    padding: 10px 20px;
    background-color: #008d00;
    /* เปลี่ยนสีพื้นหลังตามต้องการ */
    color: #ffffff;
    /* เปลี่ยนสีข้อความตามต้องการ */
    text-decoration: none;
    border-radius: 5px;
}

.login:hover {
    background-color: #5ba15e;
    /* เปลี่ยนสีพื้นหลังเมื่อโฮเวอร์ตัวเม้าส์ */
}

.rgt {
    display: inline-block;
    padding: 10px 20px;
    background-color: #a40000;
    /* เปลี่ยนสีพื้นหลังตามต้องการ */
    color: #ffffff;
    /* เปลี่ยนสีข้อความตามต้องการ */
    text-decoration: none;
    border-radius: 5px;
}

.rgt:hover {
    background-color: #bd434d;
    /* เปลี่ยนสีพื้นหลังเมื่อโฮเวอร์ตัวเม้าส์ */
}
</style>

<body>

    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo4.png" width="70px" height="70px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                <a href="login.php" class="login m-4 text-white"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                <a href="register.php" class="rgt  text-white"><i class="fa-solid fa-pen-to-square"></i> Register</a>
            </div>
        </div>
    </nav>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</body>

</html>