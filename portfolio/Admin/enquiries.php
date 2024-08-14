<?php
include 'includes/header.php';
require_once '../config/funtion.php';

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Enquiries List</h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $enquiries = getAll('enquires');
                        if($enquiries){
                            if(mysqli_num_rows($enquiries) > 0) {
                                while($enquiry = mysqli_fetch_assoc($enquiries)) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($enquiry['id']); ?></td>
                                        <td><?= htmlspecialchars($enquiry['name']); ?></td>
                                        <td><?= htmlspecialchars($enquiry['phone']); ?></td>
                                        <td><?= htmlspecialchars($enquiry['service']); ?></td>
                                        <td><?= $enquiry['status'] == 1 ? 'Processed' : 'Pending'; ?></td>
                                        <td>
                                            <a href="enquiries-edit.php?id=<?= htmlspecialchars($enquiry['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="enquiries-delete.php?id=<?= htmlspecialchars($enquiry['id']); ?>" 
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
                                    <td colspan="8">No Record Found</td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8">Something Went Wrong!</td>
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
