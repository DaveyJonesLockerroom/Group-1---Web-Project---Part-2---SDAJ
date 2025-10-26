<header>
     <!-- The navigation bar and logo -->
    <nav class="navbar">
        <a href="index.php" class="logo" target="_blank"><img src="images/company_logo.png" alt="companylogo"></a>

        <nav class="navigationbar">
            <a href="index.php" class="navtitle" >Home</a>
            <a href="jobs.php" class="navtitle" >Careers</a>
            <a href="about.php" class="navtitle" >About</a>
            <a href="manage.php" class="navtitle" >Manage</a>
            <?php if(isset($_SESSION['username'])): ?>
            <a href="signout.php" class="navtitle" >Sign Out</a>
            <?php else: ?>
            <a href="login.php" class="navtitle" >Login</a>
            <?php endif; ?>
            
        </nav>
    </nav>
  </header>