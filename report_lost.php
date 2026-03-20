<?php
if (!isset($_COOKIE["user"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Report Lost Item</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
        }

        /* Sidebar Layout */
        .container {
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #2f5f9e;
            min-height: 100vh;
            color: white;
        }

        .logo {
            text-align: center;
            padding: 20px;
        }

        .logo img {
            width: 120px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .menu li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .menu li a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: white;
        }

        .menu li a:hover {
            background: #214a7c;
        }

        /* Main Section */
        .main {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Form Styling (Matched with Login page) */
        .form-box {
            background: #fff;
            padding: 30px 40px;
            width: 100%;
            max-width: 450px;
            border-radius: 6px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-box h2 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .form-box input[type="text"],
        .form-box input[type="date"],
        .form-box select,
        .form-box textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-box textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-box input[type="file"] {
            width: 100%;
            padding: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .form-box button {
            width: 100%;
            padding: 12px;
            background: #2575fc;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .form-box button:hover {
            background: #1a5fd0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="Lost & Found Logo" onerror="this.style.display='none'">
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="report_lost.php" style="background:#214a7c;">Report Lost Item</a></li>
                <li><a href="report_found.php">Report Found Item</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="form-box">
                <h2>Report a Lost Item</h2>
                <form action="php/save_lost.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" placeholder="E.g. Blue Backpack" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description"
                            placeholder="Describe the item's appearance, brand, or unique features..."
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Date Lost</label>
                        <input type="date" name="lost_date" required>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="Electronics">Electronics</option>
                            <option value="Wallet">Wallet</option>
                            <option value="ID Card">ID Card</option>
                            <option value="Clothing">Clothing</option>
                            <option value="Academic">Academic</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Location Lost</label>
                        <input type="text" name="location" placeholder="E.g. Library 2nd Floor, Canteen" required>
                    </div>

                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="tel" name="contact" placeholder="Phone number for contact" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number" required>
                    </div>

                    <div class="form-group">
                        <label>Upload Image (Optional)</label>
                        <input type="file" name="item_image" accept="image/*">
                    </div>

                    <button type="submit">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>