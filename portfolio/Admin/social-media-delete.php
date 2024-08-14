<?php
require '../config/funtion.php';
$paramResult = checkParamId('id');
if (is_numeric($paramResult)) {
    $serviceId = validate($paramResult);
    $service = getById('services', $serviceId);
    if ($service['status'] == 200) {
        $serviceDeleteRes = deleteById('services', $serviceId);
        if ($serviceDeleteRes) {
            redirect('services.php', 'Service deleted successfully');
        } else {
            redirect('services.php', 'Something went wrong');
        }
    } else {
        redirect('services.php', $service['message']);
    }
} else {
    redirect('services.php', $paramResult);
}
?>
