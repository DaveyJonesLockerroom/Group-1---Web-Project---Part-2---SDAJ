<?php if (isset($_SESSION['error'])): ?>
<div class="alert-wrapper">
<input type="checkbox" id="close-error-alert">
<div class="error_alert">
  <label for="close-error-alert" class="close">&times;</label>
  <p><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></p>
</div>
</div>
<?php unset($_SESSION['error']); endif; ?>