<?php
require_once "../config/funtion.php";
if (isset($_GET['id'])) {
    $id = validate($_GET['id']);
    $service = getById('services', $id);

    if ($service['status'] == 200) {
        $query = "DELETE FROM services WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            redirect('services.php', 'Service Deleted Successfully');
        } else {
            redirect('services.php', 'Something went wrong');
        }
    } else {
        redirect('services.php', 'No Such ID Found');
    }
} else {
    redirect('services.php', 'ID missing from URL');
}
?>
