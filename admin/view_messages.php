<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
require_once '../includes/header.php';

require_admin();

// Get all messages
$messages_result = $conn->query("SELECT m.*, u.first_name, u.last_name FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.created_at DESC");

// Mark as read
if (isset($_GET['mark_read'])) {
    $msg_id = $_GET['mark_read'];
    $conn->query("UPDATE messages SET is_read = 1 WHERE id = $msg_id");
    header('Refresh: 0');
}
?>

<div class="container">
    <div class="admin-section">
        <h2>Messages</h2>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($msg = $messages_result->fetch_assoc()): ?>
                    <tr class="<?php echo $msg['is_read'] ? '' : 'unread'; ?>">
                        <td><?php echo htmlspecialchars($msg['first_name'] . ' ' . $msg['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($msg['email']); ?></td>
                        <td><?php echo htmlspecialchars(substr($msg['message'], 0, 50)); ?>...</td>
                        <td><?php echo date('M d, Y', strtotime($msg['created_at'])); ?></td>
                        <td><span class="status <?php echo $msg['is_read'] ? 'read' : 'unread'; ?>"><?php echo $msg['is_read'] ? 'Read' : 'Unread'; ?></span></td>
                        <td>
                            <a href="view_message.php?id=<?php echo $msg['id']; ?>" class="btn btn-sm">View</a>
                            <?php if (!$msg['is_read']): ?>
                                <a href="?mark_read=<?php echo $msg['id']; ?>" class="btn btn-sm">Mark Read</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>