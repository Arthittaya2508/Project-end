<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/Project02/guest/home.php");
exit();
?>