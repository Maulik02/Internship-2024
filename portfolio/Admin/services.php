<?php include 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Services
                    <a href="services-create.php" class="btn btn-primary float-end">Add Services</a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $services = getAll('services');
                        if($services){
                            if(mysqli_num_rows($services) > 0) {
                                foreach($services as $service) {
                                    ?>
                                    <tr>
                                        <td><?= $service['id']; ?></td>
                                        <td><?= $service['name']; ?></td>
                                        <td><?= $service['status'] == 1 ? 'Hidden' : 'Visible'; ?></td>
                                        <td>
                                            <a href="services-edit.php?id=<?= $service['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="services-delete.php?id=<?= $service['id']; ?>" 
                                               class="btn btn-danger btn-sm mx-2"
                                               onclick="return confirm('Are you sure you want to delete this record?');">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Record Found</td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5">Something Went Wrong!</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
