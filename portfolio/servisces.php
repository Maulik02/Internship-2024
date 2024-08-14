<?php
$pageTitle = "Services";
include 'includes/header.php';
?>
<div class="py-5 bg-secondary">
    <div class="container">
        <h4 class="text-white text-center">Our Services</h4>
    </div>
</div>
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <?php 
                $serviceQuery = "SELECT * FROM services WHERE status='0'";
                $result = mysqli_query($conn, $serviceQuery);
                if ($result) {
                    if(mysqli_num_rows($result) > 0){
                        foreach($result as $row){
                            ?>
                            
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <?php if($row['image'] != '') : ?>
                                        <img src="<?= htmlspecialchars($row['image']) ?>" class="w-100 rounded" alt="Img" style="min-height:200px;max-height:200px;">
                                    <?php else: ?>
                                        <img src="assets/images/no-img.jpg" class="w-100 rounded" alt="Img" style="min-height:200px;max-height:200px;">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5><?= htmlspecialchars($row['name']) ?></h5>
                                        <p>
                                            <?= htmlspecialchars($row['small_description']) ?>
                                        </p>
                                        <div>
                                            <a href="service.php?slug=<?= htmlspecialchars($row['slug']) ?>" class="text-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                    ?>
                    <div class="col-md-12">
                        <h5>No Services Available</h5>
                    </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col-md-12">
                        <h5>Something went wrong!</h5>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
