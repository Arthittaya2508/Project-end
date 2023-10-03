<?php
session_start();
if(!isset($_SESSION["id"]))
{
$row=header("location:login.php");
}
?>

<?php include 'condb.php';?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>report</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
       <?php include 'menu1.php'; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        

                        <div class="card mb-4 mt-4">
                            <div class="card-header alert">

                                <div>
                                   </div>

                            <div class="card-body">

        <div class="row">
            <div class="col-sm-5">

                            <form method="POST" action="insert_employee.php">

        <div class="alert alert-success h4 text-center mb-4" role="alert">
 เพิ่มข้อมูลพนักงาน
</div>

 ชื่อ <input type="text" name="firstname" class="form-control" required placeholder="ชื่อ..">
 นามสกุล <input type="text" name="lastname" class="form-control" required placeholder="นามสกุล..">
 ที่อยู่ <textarea class="form-control"  name="address" placeholder="ที่อยู่..." rows="3" required></textarea>
 เบอร์โทรศัพท์ <input type="number" name="phone" class="form-control" required placeholder="เบอร์โทรศัพท์..">
 ตำแหน่ง <input type="text" name="position" class="form-control" required placeholder="ตำแหน่ง..">
 Username <input type="text" name="username" maxlength="10" class="form-control" required>
 Password <input type="text" name="password" maxlength="10" class="form-control" required> <br>
 <input type="submit" name="submit" value="บันทึก" class="btn btn-success" > 
 <a href="show_employee.php" class="btn btn-danger">ยกเลิก</a>
</form>

</div>
    </div>
      
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'footer.php'; ?>

                


            </div>
        </div>
        
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
