<?php
    include "db.php";

    $user_email = $_COOKIE["user"];
    $item_name = $_POST["item_name"];
    $description = $_POST["description"];
    $found_date = $_POST["found_date"];
    $location = $_POST["location"];
    $contact = $_POST["contact"];
    $category = $_POST["category"];
    
    $image_path = "";
    if (isset($_FILES["item_image"]) && $_FILES["item_image"]["error"] == 0) {
        // 1. Path for the server to move the file (relative to this PHP file)
        $upload_dir = "../uploads/found/"; 
        
        // Ensure folder exists (Safety check)
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["item_image"]["name"]);
        $target_file = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
            // 2. Path for the HTML <img> tag (relative to dashboard.php)
            $image_path = "uploads/found/" . $file_name;
        }
    }

    $sql = "INSERT INTO found_items (user_email, item_name, description, found_date, location, contact, category, image_path) VALUES ('$user_email', '$item_name', '$description', '$found_date', '$location', '$contact', '$category', '$image_path')";

    $result = mysqli_query($conn, $sql);

    header("Location: ../dashboard.php?type=found");
?>
