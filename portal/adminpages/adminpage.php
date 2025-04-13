<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - PrepPal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="/PrepPal/styles/adminstyles/adminpage.css" />
</head>
<body>
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="admindashboard.php">
        <div class="logo">
            <img src="/PrepPal/uploads/Copy_of_PrepPal-removebg-preview.png" alt="PrepPal Logo" />
        </div></a>
        <ul class="nav-links">
            <li class="<?= $current_page == 'admindashboard.php' ? 'active' : '' ?>">
            <a href="admindashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="<?= $current_page == 'adminrecipe.php' ? 'active' : '' ?>">
                <a href="adminrecipe.php"><i class="fas fa-utensils"></i> Recipes</a></li>
            <li class="<?= $current_page == 'adminusers.php' ? 'active' : '' ?>">
                <a href="adminusers.php"><i class="fas fa-users"></i> Users</a></li>
            <li class="<?= $current_page == 'adminreviews.php' ? 'active' : '' ?>">
                <a href="adminreviews.php"><i class="fas fa-comments"></i> Reviews</a></li>
            <li>
                <a href="../logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
        </ul>
</aside>
    <!-- Scripts -->
    <script src="/PrepPal/scripts/adminscripts/admin.js"></script>
</body>
</html>
