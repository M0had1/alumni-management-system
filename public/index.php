<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
?>

<div class="hero">
    <div class="hero-content">
        <h1>Welcome to Alumni Management System</h1>
        <p>Reconnect with your alma mater and fellow alumni</p>
        <?php if (!is_logged_in()): ?>
            <div class="hero-buttons">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-secondary">Register</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <section class="features">
        <h2>Why Join Us?</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Network</h3>
                <p>Connect with thousands of alumni from your institution</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-briefcase"></i>
                <h3>Career</h3>
                <p>Find job opportunities and professional collaborations</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-calendar"></i>
                <h3>Events</h3>
                <p>Stay updated with alumni reunions and events</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-lightbulb"></i>
                <h3>Mentorship</h3>
                <p>Share knowledge and mentor fellow alumni</p>
            </div>
        </div>
    </section>
</div>

<?php require_once '../includes/footer.php'; ?>