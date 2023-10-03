<?php include 'condb.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >   
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
<style>
        #image-preview {
            max-width: 200px;
        }
    </style> 
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-sm-6 bg-light text-dark">
        <div class="alert alert-primary h4 text-center mb-4 mt-4 " role="alert">
  เพิ่มข้อมูลสินค้า
</div> 
   
<form name="form1" method="POST" action="insert_product.php" enctype="multipart/form-data">
<label>ชื่อสินค้า :</label>
<input type="text" name="pname" class="form-control" placeholder="ชื่อสินค้า..." required > <br>
<label>รายละเอียดสินค้า :</label>
<textarea class="form-control" required placeholder="รายละเอียดสินค้า..." name="detail" rows="3"> </textarea> <br>
<label>ประเภทสินค้า :</label>
<select class="form-select" name="typeID" > 
<?php
$sql="SELECT * FROM type ORDER BY type_name";
$hand=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($hand)){
    ?>   
    <option value="<?=$row['type_id']?>"><?=$row['type_name']?></option>
    <?php    
}
mysqli_close($conn);
?>

</select>

<br>
<label>ราคาสินค้า :</label> 
<input type="number" name="price" class="form-control" placeholder="ราคาสินค้า..." required > <br>
<label>จำนวนสินค้าคงเหลือ :</label>
<input type="number" name="num" class="form-control" placeholder="จำนวนสินค้าคงเหลือ..." required > <br>
<label>รูปภาพสินค้า :</label>

<input type="file" name="file1" id="file-input" required>

    <div id="image-preview-container">
        <img id="image-preview" src="#" alt="Image Preview">
    </div>

    <script>
        const fileInput = document.getElementById('file-input');
        const imagePreview = document.getElementById('image-preview');

        fileInput.addEventListener('change', function () {
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '#';
            }
        });
    </script>
<br><br>

<!-- Your form content -->

<button type="submit" class="btn btn-success" id="submit-btn">Submit</button>

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>

<script>
    const submitButton = document.getElementById('submit-btn');

    submitButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
        
        // Use SweetAlert to show a pop-up
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to submit the form.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // You can trigger the actual form submission here
                // For example: document.getElementById('your-form-id').submit();
                Swal.fire('Submitted!', 'Your form has been submitted.', 'success');
            }
        });
    });
</script>
<a class="btn btn-danger" href="show_product_2.php" role="button">Cancel</a>
<br><br>

</form>

    </div>
  </div>

</div>

</body>
</html>