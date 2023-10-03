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
                        

                    <div class="container-fluid px-4">
<div class="alert alert-success h4 text-center mt-4" role="alert">
  รายงานการขายสินค้า
</div>

        <div>
                <form name="form1" method="POST" action="report_sale1.php">
        <div class="row">
    <div class="col-sm-2">
      <input type="date" name="dt1" class="form-control">
    </div>
    <div class="col-sm-2">
    <input type="date" name="dt2" class="form-control">
    </div>
    <div class="col-sm-4">
    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> </button>
    </div>
  </div>
                                        
                </form>
                                </div>

                                <br>
                            
                            <div class="card-body">
                                <table  class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>เลขที่ใบสั่งซื้อ</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>ลูกค้า</th>
                                            <th>ที่อยู่จัดส่งสินค้า</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>ราคารวมสุทธิ</th>
                                        </tr>
                                    </tfoot>
                                  
<?php
$ddt1=@$_POST['dt1'];
$ddt2=@$_POST['dt2'];
$add_date= date('Y/m/d', strtotime($ddt2. "+1 days"));

if(($ddt1 !="") & ($ddt2 !="")){   //ต้องไม่เท่ากับค่าว่าง
echo "ค้นหาจากวันที่ $ddt1 ถึง $ddt2 " ;
$sql ="select * from tb_order where order_status='2' and reg_date BETWEEN '$ddt1' and '$add_date'
order by reg_date DESC";
}else{
    $sql ="select * from tb_order where  order_status='2' order by reg_date DESC";
}

$total_sum=0;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$total_sum = $total_sum + $row['total_price'];


?>
                                        <tr>
                                            <td><?=$row['orderID']?></td>
                                            <td><?=$row['reg_date']?></td>
                                            <td><?=$row['cus_name']?></td>
                                            <td><?=$row['address']?></td>
                                            <td><?=$row['telephone']?></td>
                                            <td><?=$row['total_price']?></td>                                          
                                        </tr>

                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                    
                                </table>

                                <b><div class="text-end">รวมเป็นเงินทั้งหมด <?=number_format($total_sum,2)?> บาท</div></b>

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
