<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFAFA;
        }

        .container {
            display: flex;
            margin-top: 130px;
        }

        .img {
            margin-left: -70px;
        }


        .button-container {
            text-align: center;

        }

        input[type="submit"],
        input[type="reset"] {
            width: 100px;

        }
    </style>

</head>

<body>
    <div class="container">
        <br><br>

        <div class="img">
            <img src="img\ploynappan03.png" class="img" alt="Image" width="1000" height="600">
        </div>

        <div class="cd col-md-4 mx-auto badgeb  bg-light text-dark">
            <div class="alert alert-success h4" role="alert">
                สมัครสมาชิก
            </div>
            <form method="POST" action="insert_register.php" enctype="multipart/form-data">
                ชื่อ <input type="text" name="firstname" class="form-control" required>
                นามสกุล <input type="text" name="lastname" class="form-control" required>
                ที่อยู่ <textarea class="form-control" required placeholder="ที่อยู่..." name="address" rows="3"> </textarea>
                เบอร์โทรศัพท์ <input type="number" name="phone" class="form-control" required>
                เพิ่มรูปโปรไฟล์ <input type="file" name="image" class="form-control-file" accept="image/*" required><br>
                Username <input type="text" name="username" maxlength="10" class="form-control" required>
                Password <input type="password" name="password" maxlength="10" class="form-control" required> <br>

                <div class="button-container">
                    <input type="submit" name="submit" value="บันทึก" class="btn btn-success center">
                    <input type="reset" name="cancel" value="ยกเลิก" class="btn btn-success">
                </div>


            </form>
        </div>
    </div>

</body>

</html>