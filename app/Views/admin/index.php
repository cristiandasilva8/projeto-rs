<?= $this->extend('layouts/admin.php'); ?>
<?= $this->section('content'); ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success'); ?>
    </div>
<?php endif; ?>
<h1>Index do admin</h1>


<?= $this->endsection(); ?>