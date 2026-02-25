<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
require_once '../includes/header.php';

require_admin();

// Get statistics
$users_result = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'alumni'");
$users_count = $users_result->fetch_assoc()['total'];

$posts_result = $conn->query("SELECT COUNT(*) as total FROM posts");
$posts_count = $posts_result->fetch_assoc()['total'];

$messages_result = $conn->query("SELECT COUNT(*) as total FROM messages WHERE is_read = 0");
$unread_messages = $messages_result->fetch_assoc()['total'];

// Get recent alumni
$recent_alumni = $conn->query("SELECT * FROM users WHERE role = 'alumni' ORDER BY created_at DESC LIMIT 5");
?>

<div class="container">
    <div class="admin-dashboard">
        <h2>Admin Dashboard</h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <h3><?php echo $users_count; ?></h3>
                    <p>Total Alumni</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                <div class="stat-content">
                    <h3><?php echo $posts_count; ?></h3>
                    <p>Total Posts</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-envelope"></i></div>
                <div class="stat-content">
                    <h3><?php echo $unread_messages; ?></h3>
                    <p>Unread Messages</p>
                </div>
            </div>
        </div>
        
        <div class="admin-sections">
            <div class="section">
                <h3>Recent Alumni Registrations</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Graduation Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($alumni = $recent_alumni->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumni['first_name'] . ' ' . $alumni['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($alumni['email']); ?></td>
                                <td><?php echo htmlspecialchars($alumni['graduation_year']); ?></td>
                                <td>
                                    <a href="view_alumni.php?id=<?php echo $alumni['id']; ?>" class="btn btn-sm">View</a>
                                    <a href="delete_alumni.php?id=<?php echo $alumni['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="section">
                <h3>Quick Actions</h3>
                <div class="quick-actions">
                    <a href="manage_alumni.php" class="btn btn-primary"><i class="fas fa-users"></i> Manage Alumni</a>
                    <a href="view_messages.php" class="btn btn-primary"><i class="fas fa-envelope"></i> View Messages</a>
                    <a href="settings.php" class="btn btn-secondary"><i class="fas fa-cog"></i> Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>