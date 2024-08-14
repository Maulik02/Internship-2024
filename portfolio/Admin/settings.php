<?php
require_once '../config/funtion.php';

include 'includes/header.php';

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Website Settings</h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <?php
                        $setting = getById('settings', 1);
                    ?>
                    <input type="hidden" name="settingId" value="<?= $setting['data']['id'] ?? 'insert' ?>">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="<?= $setting['data']['title'] ?? "" ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Url / Domain</label>
                        <input type="text" name="slug" value="<?= $setting['data']['slug'] ?? "" ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Small Description</label>
                        <input type="text" name="small_description" value="<?= $setting['data']['small_description'] ?? "" ?>" class="form-control">
                    </div>
                    <h4 class="my-3">SEO Setting</h4>
                    <div class="mb-3">
                        <label>Meta Description</label>
                        <input type="text" name="meta_description" value="<?= $setting['data']['meta_description'] ?? "" ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keyword" value="<?= $setting['data']['meta_keyword'] ?? "" ?>" class="form-control">
                    </div>
                    <h4 class="my-3">Contact Setting</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= $setting['data']['email'] ?? "" ?>" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" value="<?= $setting['data']['phone'] ?? "" ?>" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="3"><?= $setting['data']['address'] ?? "" ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <button name="saveSetting" type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
