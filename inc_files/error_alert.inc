<?php if (isset($_SESSION['error'])): ?>
<input type="checkbox" id="close-alert">
<div class="error_alert">
  <label for="close-alert" class="close">&times;</label>
  <p><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></p>
</div>
<?php unset($_SESSION['error']); endif; ?>