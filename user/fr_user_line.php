<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Notify</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>
<body>

    <div class="container">
        <form method="POST" action="insert_lineNotify.php">
            <br>
            <h4>แจ้งเตือนผ่าน Line Notify</h4>
            <br>

            <?php if(isset($_SESSION['success'])){?>
                <div class="alert alert-success" role="alert">
               <?php echo $_SESSION['success'] ; 
                    unset($_SESSION['success']) ;
               ?>
              </div>
            <?php } ?>


            <?php if(isset($_SESSION['error'])){?>
                <div class="alert alert-success" role="alert">
               <?php echo $_SESSION['error'] ; 
                    unset($_SESSION['error']) ;
               ?>
              </div>
            <?php } ?>
            <br>


            ชื่อ-นามสกุล:
            <input type="text" name="pname" class="form-control" required placeholder="ชื่อ - นามสกุล"> <br>
            อีเมลล์:
            <input type="email" name="email" class="form-control" required placeholder="name@example.com"> <br>
            ที่อยู่:
            <textarea class="form-control"  name="address" row="3" placeholder="ที่อยู่"> </textarea> 

            <button type="submit" name="submit" class="btn btn-success mt-4">submit</button>

        </form>


    </div>
   
</body>
</html>