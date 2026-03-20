<?php
if (!isset($_COOKIE["user"])) {
    header("Location: login.php");
    exit();
}
include("php/db.php");

$type = isset($_GET['type']) ? $_GET['type'] : 'lost';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? $_GET['category'] : 'All Categories';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lost & Found Portal - Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
        }

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

        .main {
            flex: 1;
            padding: 30px;
        }

        .title {
            text-align: center;
            color: #2f5f9e;
            margin-bottom: 20px;
        }

        .controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
        }

        .toggle-links {
            margin-bottom: 20px;
        }

        .toggle-links a {
            text-decoration: none;
            padding: 10px 20px;
            font-size: 18px;
            color: #555;
            background: #eee;
            border-radius: 4px;
            margin: 0 10px;
        }

        .toggle-links a.active {
            background: #2f5f9e;
            color: white;
            font-weight: bold;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-bar input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
        }

        .search-bar select {
            padding: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            background: #2f5f9e;
            color: white;
            border: none;
            cursor: pointer;
        }

        .latest {
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .item-card {
            background: white;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            transition: 0.2s;
            display: flex;
            flex-direction: column;
        }

        .item-card:hover {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .item-card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .item-card h3 {
            margin: 10px 0 5px 0;
            font-size: 18px;
        }

        .item-card p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .category {
            font-weight: bold;
            color: #2f5f9e !important;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="sidebar">

            <div class="logo">
                <img src="images/logo.png" alt="College Logo" onerror="this.style.display='none'">
            </div>

            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="report_lost.php">Report Lost Item</a></li>
                <li><a href="report_found.php">Report Found Item</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </div>

        <div class="main">

            <h1 class="title">Lost & Found Portal</h1>

            <div class="controls">
                <div class="toggle-links">
                    <a href="dashboard.php?type=lost" class="<?php echo ($type == 'lost') ? 'active' : ''; ?>">View Lost
                        Items</a>
                    <a href="dashboard.php?type=found" class="<?php echo ($type == 'found') ? 'active' : ''; ?>">View
                        Found Items</a>
                </div>

                <form class="search-bar" method="GET" action="dashboard.php">
                    <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">

                    <input type="text" name="search" placeholder="Search items..."
                        value="<?php echo htmlspecialchars($search); ?>">
                    <select name="category">
                        <option value="All Categories" <?php echo ($category == 'All Categories') ? 'selected' : ''; ?>>
                            All Categories</option>
                        <option value="Electronics" <?php echo ($category == 'Electronics') ? 'selected' : ''; ?>>
                            Electronics</option>
                        <option value="Wallet" <?php echo ($category == 'Wallet') ? 'selected' : ''; ?>>Wallet</option>
                        <option value="ID Card" <?php echo ($category == 'ID Card') ? 'selected' : ''; ?>>ID Card</option>
                        <option value="Clothing" <?php echo ($category == 'Clothing') ? 'selected' : ''; ?>>Clothing
                        </option>
                        <option value="Academic" <?php echo ($category == 'Academic') ? 'selected' : ''; ?>>Academic
                        </option>
                        <option value="Other" <?php echo ($category == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <button type="submit">Search</button>
                    <a href="dashboard.php?type=<?php echo htmlspecialchars($type); ?>"
                        style="padding:10px; text-decoration:none; color:#2f5f9e;">Clear</a>
                </form>
            </div>

            <?php

            $table_name = ($type == 'found') ? 'found_items' : 'lost_items';

            $sql = "SELECT * FROM $table_name WHERE 1=1";

            if (!empty($search)) {
                $sql .= " AND (item_name LIKE '%$search%' OR description LIKE '%$search%')";
            }

            if ($category != 'All Categories') {
                $sql .= " AND category = '$category'";
            }

            $sql .= " ORDER BY created_at DESC LIMIT 20";


            $result = mysqli_query($conn, $sql);
            $title_text = ($type == 'found') ? "Found Items" : "Lost Items";
            $date_label = ($type == 'found') ? "Found on:" : "Lost on:";
            ?>

            <h2 class="latest"><?php echo $title_text; ?></h2>
            <div class="items-grid">
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='item-card'>";

                        if (!empty($row['image_path'])) {
                            echo "<img src='" . htmlspecialchars($row['image_path']) . "'>";
                        } else {
                            echo "<div style='width:100%; height:170px; background:#ddd; display:flex; align-items:center; justify-content:center; color:#888;'>No Image</div>";
                        }

                        echo "<h3>" . htmlspecialchars($row['item_name']) . "</h3>";
                        echo "<p class='category'>" . htmlspecialchars($row['category']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p><b>$date_label</b> " . htmlspecialchars($row[$type . '_date']) . "</p>";
                        echo "<p><b>Location:</b> " . htmlspecialchars($row['location']) . "</p>";
                        echo "<p><b>Contact:</b> " . htmlspecialchars($row['contact']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No matching items found.</p>";
                }
                ?>
            </div>

        </div>

    </div>

</body>

</html>