<?php
    include "db.php";
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password_) VALUES ('$name', '$email', '$password')";
    $result = mysqli_query($conn, $sql);

    header ("Location: ../login.php");
?>