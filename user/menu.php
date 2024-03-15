<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
    .nav-link.active {
        color: #007bff;
    }

    .nav-item:hover .nav-link {
        color: #6c757d;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    </style>
</head>

<body>
    <?php
include 'condb.php';

$sql ="SELECT * FROM `member` ORDER BY `member`.`image` ASC";
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username']; 
}

?>



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
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php"><i class="fa-solid fa-basket-shopping"></i> My
                            Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="pay_ment.php"><i class="fa-solid fa-credit-card"></i>
                            Payment</a>
                    </li>

                </ul>


                <form class="d-flex" method="POST" action="search.php">
                    <input class="form-control me-2" type="text" name="pname" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success btn-pink" type="submit">Search</button>
                </form>
                <!-- แสดงชื่อผู้ใช้ -->
                <!-- แสดงชื่อผู้ใช้ -->
                <?php
    if(isset($username)) {
        echo '<span class="navbar-text ms-3 text-white">'.$username.'</span>';
        }
?>


                <!-- รูปโปรไฟล์ -->

                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="img/<?=$row['image']?>" width="30" height="30" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href=""><i class="fa-solid fa-user"></i> My Account</a></li>
                            <li><a class="dropdown-item" href="history.php"><i class="fa-solid fa-file-lines"></i>
                                    History</a>
                            </li>
                            <li><a class="dropdown-item" href="setting.php"><i class="fa-solid fa-gear"></i> Setting</a>
                            </li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="logout.php"><i
                                        class="fa-solid fa-right-from-bracket"></i>
                                    Logout</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</body>

</html>