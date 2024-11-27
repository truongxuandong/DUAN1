<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['message'] ?>
        <?php unset($_SESSION['message']) ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']) ?>
    </div>
<?php endif; ?> 