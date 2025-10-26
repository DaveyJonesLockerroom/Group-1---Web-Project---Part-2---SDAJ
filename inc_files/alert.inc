<?php if (isset($_SESSION['alert'])): ?>
<div class="alert-wrapper">
<input type="checkbox" id="close-alert">
<div class="alert">
  <label for="close-alert" class="close">&times;</label>
  <p><?= htmlspecialchars($_SESSION['alert'], ENT_QUOTES, 'UTF-8') ?></p>
</div>
</div>
<?php unset($_SESSION['alert']); endif; ?>