<?php
    include "db.php";

    $user_email = $_COOKIE["user"];
    $item_name = $_POST["item_name"];
    $description = $_POST["description"];
    $lost_date = $_POST["lost_date"];
    $location = $_POST["location"];
    $contact = $_POST["contact"];
    $category = $_POST["category"];
    
    $image_path = "";
    if (isset($_FILES["item_image"]) && $_FILES["item_image"]["error"] == 0) {
        $upload_dir = "../uploads/lost/";
        $file_name = time() . "_" . basename($_FILES["item_image"]["name"]);
        $target_file = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
            $image_path = "uploads/lost/" . $file_name;
        }
    }

    $sql = "INSERT INTO lost_items (user_email, item_name, description, lost_date, location, contact, category, image_path) VALUES ('$user_email', '$item_name', '$description', '$lost_date', '$location', '$contact', '$category', '$image_path')";

    $result = mysqli_query($conn, $sql);

    header("Location: ../dashboard.php?type=lost");
?>
