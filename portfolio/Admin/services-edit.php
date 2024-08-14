<?php
include 'includes/header.php';
require_once "../config/funtion.php";

if (isset($_GET['id'])) {
    $id = validate($_GET['id']);
    $query = "SELECT * FROM services WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();
    if (!$service) {
        redirect('services.php', 'No Such ID Found');
    }
} else {
    redirect('services.php', 'ID missing from URL');
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Service
                    <a href="services.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="serviceId" value="<?= $service['id']; ?>">
                    <div class="mb-3">
                        <label>Service Name</label>
                        <input type="text" name="name" required class="form-control" value="<?= $service['name']; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label>Small Description</label>
                        <textarea name="small_description" required class="form-control" rows="3"><?= $service['small_description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Long Description</label>
                        <textarea name="long_description" required class="form-control" rows="3"><?= $service['long_description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Service Image</label>
                        <input type="file" name="image" class="form-control"/>
                        <?php if ($service['image']): ?>
                            <img src="../<?= $service['image']; ?>" alt="<?= $service['name']; ?>" width="100">
                        <?php endif; ?>
                    </div>

                    <h5>SEO Tags</h5>
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" required class="form-control" value="<?= $service['meta_title']; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label>Meta Description</label>
                        <input type="text" name="meta_description" required class="form-control" value="<?= $service['meta_description']; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keyword" required class="form-control" value="<?= $service['meta_keyword']; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label>Status (checked=hidden,un-checked=visible)</label>
                        <br/>
                        <input type="checkbox" name="status" style="width:30px;height:30px;" <?= $service['status'] ? 'checked' : ''; ?>/>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" name="updateService" class="btn btn-primary">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
