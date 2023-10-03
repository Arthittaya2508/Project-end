<?php
// เริ่มคำสั่ง Export ไฟล์ PDF
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ], 
    'default_font' => 'sarabun'
]);
 // สิ้นสุดคำสั่ง Export ไฟล์ PDF ในส่วนบน เริ่มกำหนดตำแหน่งเริ่มต้นในการนำเนื้อหามาแสดงผลผ่าน
$mpdf->SetFont('sarabun','',14);

ob_start();  //ฟังก์ชัน ob_start()
?>

<?php
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <div class="container">
        <br>
        <h4 class="text-center">แสดงข้อมูลสินค้า</h4>
        <br>
        <table class="table">
    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>จำนวนสินค้า</th>
        <th class="text-end">ราคาสินค้า</th>
    </tr>
<?php
$total=0;
$sql="select * from product order by pro_id" ;
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$total=$total + $row['price'];

?>
    <tr>
        <td><?=$row['pro_id']?></td>
        <td><?=$row['pro_name']?></td>
        <td><?=$row['amount']?></td>
        <td class="text-end"><?=$row['price']?></td>
    </tr>
<?php
}
mysqli_close($conn);
?>

</table>
<h5 class="text-end">รวมเป็นเงิน: <?=number_format($total,2)?></h5>
<?php
 // คำสั่งการ Export ไฟล์เป็น PDF
$html = ob_get_contents();      // เรียกใช้ฟังก์ชัน รับข้อมูลที่จะมาแสดงผล
$mpdf->WriteHTML($html);        // รับข้อมูลเนื้อหาที่จะแสดงผลผ่านตัวแปร $html
$mpdf->Output('Report.pdf');  //สร้างไฟล์ PDF ชื่อว่า myReport.pdf
ob_end_flush();                 // ปิดการแสดงผลข้อมูลของไฟล์ HTML ณ จุดนี้
?>

<!--การสร้างลิงค์ เรียกไฟล์ myReport.pdf แสดงผลไฟล์ PDF  -->
<a href="Report.pdf"><button class="btn btn-primary">Export PDF</button> </a>

</div>    
</body>
</html>