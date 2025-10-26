
<nav class="index_navbar">
    <a href="jobs.php">Careers</a>
    <a href="about.php">About</a>
    <a href="manage.php">Manage</a>
    <?php if(isset($_SESSION['username'])): ?>
    <a href="signout.php">Sign Out</a>
    <?php else: ?>
    <a href="login.php">Login</a>
    <?php endif; ?>
</nav>