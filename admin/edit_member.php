<?php
session_start();
if(!isset($_SESSION["id"]))
{
$row=header("location:login.php");
}
?>

<?php 
include 'condb.php';
$id=$_GET['id'];
$sql="SELECT * FROM member WHERE id='$id' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

?>


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
        
        <div class="alert alert-success h4 text-center mb-4" role="alert">
  แก้ไขข้อมูลลูกค้า
</div> 

<form method="POST" action="update_member.php">
    <label>รหัสมาชิก :</label>
    <input type="text" name="id_mem" class="form-control" readonly value=<?=$row['id']?>  > <br>    
    <label>ชื่อ :</label>
    <input type="text" name="fname" class="form-control" value=<?=$row['name']?>  > <br>
    <label>นามสกุล :</label>
    <input type="text" name="lname" class="form-control" value=<?=$row['lastname']?>  > <br>
    <label>ที่อยู่ :</label>
    <textarea  name="address" class="form-control" value="<?=$row['address']?>"> </textarea> <br>
    <label>เบอร์โทรศัพท์ :</label>
    <input type="number" name="telephone" class="form-control" value=<?=$row['telephone']?> > <br>
    <input type="submit" name="Update" class="btn btn-success" >
    <a href="show_member.php" class="btn btn-danger">Cencel</a> <br><br>
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
