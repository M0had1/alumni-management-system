<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>Alumni Management</span>
            </div>
            <ul class="navbar-menu">
                <li><a href="../public/index.php">Home</a></li>
                <?php if (is_logged_in()): ?>
                    <?php if (is_admin()): ?>
                        <li><a href="../admin/dashboard.php">Dashboard</a></li>
                        <li><a href="../admin/manage_alumni.php">Manage Alumni</a></li>
                        <li><a href="../admin/view_messages.php">Messages</a></li>
                    <?php elseif (is_alumni()): ?>
                        <li><a href="../alumni/dashboard.php">My Dashboard</a></li>
                        <li><a href="../alumni/profile.php">My Profile</a></li>
                    <?php endif; ?>
                    <li><a href="../auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../auth/login.php">Login</a></li>
                    <li><a href="../auth/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>