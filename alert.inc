<?php if (isset($_SESSION['error'])): ?>
<div class="toast"><?= htmlspecialchars($_SESSION['error']) ?></div>
<?php unset($_SESSION['error']); endif; ?>