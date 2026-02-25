<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $graduation_year = $_POST['graduation_year'] ?? '';
    
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($graduation_year)) {
        if ($password === $confirm_password) {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $role = 'alumni';
                
                $insert_stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, graduation_year, role) VALUES (?, ?, ?, ?, ?, ?)");
                $insert_stmt->bind_param("ssssss", $first_name, $last_name, $email, $hashed_password, $graduation_year, $role);
                
                if ($insert_stmt->execute()) {
                    $success = "Registration successful! Please login.";
                    header('Refresh: 2; url=login.php');
                } else {
                    $error = "Error in registration";
                }
            } else {
                $error = "Email already exists";
            }
        } else {
            $error = "Passwords do not match";
        }
    } else {
        $error = "Please fill all fields";
    }
}
?>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <h2>Register</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="graduation_year">Graduation Year</label>
                    <input type="number" id="graduation_year" name="graduation_year" min="1950" max="2026" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>