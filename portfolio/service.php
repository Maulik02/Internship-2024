
<?php
$pageTitle = "Services";
include 'includes/header.php';

if(isset($_GET['slug'])) {
    if($_GET['slug'] == NULL) {
        redirect('services.php', 'Invalid service.');
    }
} else {
    redirect('services.php', 'Invalid service.');
}

$slug = validate($_GET['slug']);
$serviceQuery = "SELECT * FROM services WHERE status = '0' AND slug='$slug' LIMIT 1";
$result = mysqli_query($conn, $serviceQuery);

if(!$result) {
    redirect('services.php', 'Service not found.');
}
if(mysqli_num_rows($result) == 0) {
    redirect('services.php', 'Service not found.');
}
$rowData = mysqli_fetch_assoc($result);
?>
<div class="py-5 bg-secondary">
    <div class="container">
        <h4 class="text-white text-center"><?= htmlspecialchars($rowData['name']); ?></h4>
    </div>
</div>
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-body shadow">
                <h4><?= htmlspecialchars($rowData['name']); ?></h4>
                <div class="underline">
                    <p>
                        <?= htmlspecialchars($rowData['small_description']); ?>
                    </p>
                    <div class="mb-3">
                        <?php if($rowData['image'] != '') : ?>
                            <img src="<?= htmlspecialchars($rowData['image']); ?>" class="w-100 rounded" alt="Service Image">
                        <?php else: ?>
                            <img src="assets/images/no-img.jpg" class="w-100 rounded" alt="No Image">
                        <?php endif; ?>
                    </div>
                    <p>
                        <?= htmlspecialchars($rowData['long_description']); ?>
                    </p>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow sticky-top" style="top:120px;">
                <div class="card-header bg-warning">
                    <h4 class="text-white mb-0">Enquire Now</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="post">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label>Service</label>
                            <input type="text" readonly value="<?= htmlspecialchars($rowData['name']); ?>" class="form-control" name="service">
                        </div>
                        <div class="mb-3">
                            <label>Message</label>
                            <textarea name="message" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn w-100 btn-primary" name="enquireBtn">Submit</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
