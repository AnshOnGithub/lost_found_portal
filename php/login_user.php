<?php
    include("db.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password_'])) {
            setcookie("user", $email, time()+3600, "/");
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Invalid Login";
        }
    } else {
        echo "Invalid Login";
    }
?>