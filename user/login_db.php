<?php
session_start();
include('condb.php');

$errors = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM member WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;

                header("location: home.php");
                exit(); // Ensure that no further code execution happens after redirection
            } else {
                array_push($errors, "Wrong password");
            }
        } else {
            array_push($errors, "User not found");
        }
    }

    $_SESSION['error'] = "Wrong username or password, try again!";
    header("location: login1.php");
    exit(); // Ensure that no further code execution happens after redirection
}
?>
