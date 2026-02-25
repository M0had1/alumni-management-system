<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
require_once '../includes/header.php';

require_admin();

// Get all alumni
$alumni_result = $conn->query("SELECT * FROM users WHERE role = 'alumni' ORDER BY created_at DESC");

// Search functionality
$search = $_GET['search'] ?? ''; 
if (!empty($search)) {
    $search = "%" . $conn->real_escape_string($search) . "%";
    $alumni_result = $conn->query("SELECT * FROM users WHERE role = 'alumni' AND (first_name LIKE '$search' OR last_name LIKE '$search' OR email LIKE '$search') ORDER BY created_at DESC");
}
?>

<div class="container">
    <div class="admin-section">
        <h2>Manage Alumni</h2>
        
        <div class="search-box">
            <form method="GET">
                <input type="text" name="search" placeholder="Search alumni..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Graduation Year</th>
                    <th>Company</th>
                    <th>Joined Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($alumni = $alumni_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($alumni['first_name'] . ' ' . $alumni['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($alumni['email']); ?></td>
                        <td><?php echo htmlspecialchars($alumni['graduation_year']); ?></td>
                        <td><?php echo htmlspecialchars($alumni['company'] ?? 'N/A'); ?></td>
                        <td><?php echo date('M d, Y', strtotime($alumni['created_at'])); ?></td>
                        <td>
                            <a href="view_alumni.php?id=<?php echo $alumni['id']; ?>" class="btn btn-sm">View</a>
                            <a href="edit_alumni.php?id=<?php echo $alumni['id']; ?>" class="btn btn-sm">Edit</a>
                            <a href="delete_alumni.php?id=<?php echo $alumni['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>