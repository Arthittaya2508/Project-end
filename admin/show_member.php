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
            

                            <form method="POST" action="insert_member.php">

        <div class="alert alert-success h4" role="alert">
 รายชื่อลูกค้า
</div>

<table class="table table-striped">
    <tr>
    <th>รหัส</th>
    <th>ชื่อ</th>
    <th>นามสกุล</th>
    <th>ที่อยู่</th>
    <th>เบอร์โทรศัพท์</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>
<?php
$sql = "SELECT * FROM member";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
?>
    <tr>
    <td><?=$row["id"]?></td>
    <td><?=$row["name"]?></td>
    <td><?=$row["lastname"]?></td>
    <td><?=$row["address"]?></td>
    <td><?=$row["telephone"]?></td>
    <td><a href="edit_member.php?id=<?=$row["id"]?>" class="btn btn-success" >Edit</a></td>
    <td><a href="delete_member.php?id=<?=$row["id"]?>" class="btn btn-danger" onclick="Del(this.href);return false;">Delete</a></td>
</tr>
<?php
}
mysqli_close($conn); //ปิดการการเชื่อมต่อฐานข้อมูล
?>
</table>
    
</body>
</html>

<script language="JavaScript">
function Del(mypage){
    var agree=confirm("คุณต้องการลบข้อมูลหรือไม่");
    if(agree){
        window.location=mypage;    
    }
}
</script>

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
